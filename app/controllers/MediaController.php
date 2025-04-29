<?php
class mediaController extends Controller
{
    public function mediaIndex()
    {
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $mediaModel = $this->model('mediaModel');
        $searchColumns = array(
            0 => 'mediaId',
            1 => 'media',
            2 => 'mediaType',
            3 => 'mediumCreatedAt',
            4 => 'mediumUpdatedAt',
            5 => 'mediumIdentify',
        );
        $totalRecords = $mediaModel->countAll($search, $searchColumns);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagination = new Paginator($totalRecords, $page, 10);
        $data = $mediaModel->displayAllSearch($search, $searchColumns, $pagination->getOffset(), $pagination->getLimit());
        $params['media'] = $data;
        if ($totalRecords > $pagination->getLimit()) {
            $params['pagination'] =  $pagination->render();
        } else {
            $params['pagination'] = '';
        }
        $this->adminView('media/mediaAll', $params);
    }

    public function mediaDisplay(Request $request, $mediaIdentify)
    {
        $mediaModel = $this->model('mediaModel');
        $params['media'] =  $mediaModel->displaySingle($mediaIdentify);
        $this->adminView('media/mediaSingle', $params);
    }

    public function mediaDestroy(Request $request, $mediaIdentify)
    {
        $mediaModel = $this->model('mediaModel');
        $mediaModel->erase($mediaIdentify);
        // success delete and redirect
        header("Location:  " . ROOT . "/admin/media/");
        $_SESSION['success_message'] = "Delete successful!";
        exit;
    }

    public function mediabuild()
    {
        $this->adminView('media/mediaNew');
    }

    public function mediaRecord(Request $request)
    {
        $mediaModel = $this->model('mediaModel');
        $data = $request->getBody();
        $data['mediumCreatedAt'] = date('Y-m-d H:i:s');
        $data['mediumUpdatedAt'] = date('Y-m-d H:i:s');
        $data['mediumIdentify'] = generateUniqueId(16);

        $uploadsDir = '../public/assets/alpha-theme/img/uploads/';
        $allowedExts = ['jpg','jpeg','png','webp','gif','pdf','doc','docx','mp3','mp4']; // example
        
        $filename = uploadFile('media', $uploadsDir, $allowedExts, 52428800, true); // `true` enables thumbnail
        
        if ($filename) {
            echo "Uploaded: $filename";
        } else {
            echo "Upload failed!";
        }
        
        $data['media'] = $filename;
        $rules = array(
            'media' => '',
            'mediaType' => '',
            'mediumCreatedAt' => '',
            'mediumUpdatedAt' => '',
            'mediumIdentify' => 'required|max:50',
        );
        $validator = new Validator();
        $validator->validate($rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors as $error) {
                echo $error . "</br>";
            }
        } else {
            $mediaModel->record($data);
            // success adding and redirect
            header("Location:  " . ROOT . "/admin/media/");
            $_SESSION['success_message'] = "Added successful!";
            exit;
        }
    }

    public function mediaModify(Request $request, $mediaIdentify)
    {
        $mediaModel = $this->model('mediaModel');
        $params['mediumIdentify'] = $mediaIdentify;
        $params['media'] =  $mediaModel->displaySingle($mediaIdentify);
        $this->adminView('media/mediaEdit', $params);
    }

    public function mediaEdit(Request $request, $mediaIdentify)
    {
        $mediaModel = $this->model('mediaModel');
        $data = $request->getBody();
        $rules = array(
            'media' => '',
            'mediaType' => '',
            'mediumCreatedAt' => '',
            'mediumUpdatedAt' => '',
            'mediumIdentify' => 'required|max:50',
        );
        $validator = new Validator();

        if ($validator->fails($rules)) {
            $errors = $validator->errors();
            foreach ($errors as $error) {
                echo $error . "</br>";
            }
        } else {
            $mediaModel->modify($data, $mediaIdentify);
            // success updated and redirect
            header("Location:  " . ROOT . "/admin/media/");
            $_SESSION['success_message'] = "Update successful!";
            exit;
        }
    }
}
