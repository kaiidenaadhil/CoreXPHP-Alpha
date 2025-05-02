<?php
class productController extends Controller
{
    public function productIndex()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $productModel = $this->model('productModel');
        	$searchColumns = array (
  0 => 'productId',
  1 => 'productName',
  2 => 'price',
  3 => 'stockQuantity',
  4 => 'productType',
  5 => 'status',
  6 => 'categoryId',
  7 => 'productImage',
  8 => 'productCreatedAt',
  9 => 'productUpdatedAt',
  10 => 'productIdentify',
);
        $totalRecords = $productModel->countAll($search, $searchColumns);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = new Paginator($totalRecords, $page, 10);
        $data = $productModel->displayAllSearch($search, $searchColumns, $pagination->getOffset(), $pagination->getLimit());
        $params['product'] = $data;
        if ($totalRecords > $pagination->getLimit()) {
            $params['pagination'] =  $pagination->render();
        } else {
            $params['pagination'] = '';
        }
        $this->adminView('product/productAll', $params);
    }

    public function productDisplay(Request $request, $productIdentify)
    {
        $productModel = $this->model('productModel');
        $params['product'] =  $productModel->displaySingle($productIdentify);
        $this->adminView('product/productSingle', $params);
    }

    public function productDestroy(Request $request, $productIdentify)
    {
        $productModel = $this->model('productModel');
        $productModel->erase($productIdentify);
            // success delete and redirect
header("Location:  " . ROOT . "/admin/product/");
            $_SESSION['success_message'] = "Delete successful!";
            exit;
    }

    public function productbuild()
    {
        $this->adminView('product/productNew');
    }

    public function productRecord(Request $request)
    {
        $productModel = $this->model('productModel');
        $data = $request->getBody();
        $data['productCreatedAt'] = date('Y-m-d H:i:s');
        $data['productUpdatedAt'] = date('Y-m-d H:i:s');
        $data['productIdentify'] = generateUniqueId(16);
        // Handle file uploads
        $uploadsDir = '../public/assets/alpha-theme/img/uploads/';
        // Upload for productImage
        $allowedExts = array (
  0 => 'jpg',
  1 => 'png',
);
        $filename = uploadFile('productImage', $uploadsDir, $allowedExts, 52428800, true);
        if ($filename) {
            $data['productImage'] = $filename;
        } else {
            echo "Upload failed for productImage!";
        }

        	$rules = array (
  'productName' => 'required|max:100|unique',
  'price' => 'required|min:1',
  'stockQuantity' => 'required|min:0',
  'productType' => 'required|in:physical,digital,service',
  'status' => 'required|in:active,inactive',
  'categoryId' => 'required',
  'productImage' => 'file|nullable',
  'productCreatedAt' => '',
  'productUpdatedAt' => '',
  'productIdentify' => 'required|max:50',
);
        $validator = new Validator();
        $validator->validate($rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors as $error) {
                echo $error . "</br>";
            }
        } else {
            $productModel->record($data);
            // success adding and redirect
header("Location:  " . ROOT . "/admin/product/");
            $_SESSION['success_message'] = "Added successful!";
            exit;
        }
    }

    public function productModify(Request $request,$productIdentify)
    {
        $productModel = $this->model('productModel');
        $params['productIdentify'] = $productIdentify;
        $params['product'] =  $productModel->displaySingle($productIdentify);
        $this->adminView('product/productEdit', $params);
    }

    public function productEdit(Request $request, $productIdentify)
    {
        $productModel = $this->model('productModel');
        $data = $request->getBody();
        // Handle file uploads
        $uploadsDir = '../public/assets/alpha-theme/img/uploads/';
        // Upload for productImage
        $allowedExts = array (
  0 => 'jpg',
  1 => 'png',
);
        $filename = uploadFile('productImage', $uploadsDir, $allowedExts, 52428800, true);
        if ($filename) {
            $data['productImage'] = $filename;
        }

        	$rules = array (
  'productName' => 'required|max:100|unique',
  'price' => 'required|min:1',
  'stockQuantity' => 'required|min:0',
  'productType' => 'required|in:physical,digital,service',
  'status' => 'required|in:active,inactive',
  'categoryId' => 'required',
  'productImage' => 'file|nullable',
  'productCreatedAt' => '',
  'productUpdatedAt' => '',
  'productIdentify' => 'required|max:50',
);
        $validator = new Validator();

        if ($validator->fails($rules)) {
            $errors = $validator->errors();
            foreach ($errors as $error) {
                echo $error . "</br>";
            }
        } else {
            $productModel->modify($data, $productIdentify);
            // success updated and redirect
header("Location:  " . ROOT . "/admin/product/");
            $_SESSION['success_message'] = "Update successful!";
            exit;
        }
    }
}
