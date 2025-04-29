<?php
class inquiriesController extends Controller
{
    public function inquiriesIndex()
    {
        $search         = isset($_GET['search']) ? $_GET['search'] : '';
        $inquiriesModel = $this->model('inquiriesModel');
        $searchColumns  = [
            0 => 'inquiryId',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'eventType',
            5 => 'message',
            6 => 'inquiryCreatedAt',
            7 => 'inquiryUpdatedAt',
            8 => 'inquiryIdentify',
        ];
        $totalRecords        = $inquiriesModel->countAll($search, $searchColumns);
        $page                = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $pagination          = new Paginator($totalRecords, $page, 10);
        $data                = $inquiriesModel->displayAllSearch($search, $searchColumns, $pagination->getOffset(), $pagination->getLimit());
        $params['inquiries'] = $data;
        if ($totalRecords > $pagination->getLimit()) {
            $params['pagination'] = $pagination->render();
        } else {
            $params['pagination'] = '';
        }
        $this->adminView('inquiries/inquiriesAll', $params);
    }

    public function inquiriesDisplay(Request $request, $inquiriesIdentify)
    {
        $inquiriesModel      = $this->model('inquiriesModel');
        $params['inquiries'] = $inquiriesModel->displaySingle($inquiriesIdentify);
        $this->adminView('inquiries/inquiriesSingle', $params);
    }

    public function inquiriesDestroy(Request $request, $inquiriesIdentify)
    {
        $inquiriesModel = $this->model('inquiriesModel');
        $inquiriesModel->erase($inquiriesIdentify);
        // success delete and redirect
        header("Location:  " . ROOT . "/admin/inquiries/");
        $_SESSION['success_message'] = "Delete successful!";
        exit;
    }

    public function inquiriesbuild()
    {
        $this->adminView('inquiries/inquiriesNew');
    }

    public function inquiriesRecord(Request $request)
    {
        $inquiriesModel          = $this->model('inquiriesModel');
        $data                    = $request->getBody();
        $data['inquiryCreatedAt']  = date('Y-m-d H:i:s');
        $data['inquiryUpdatedAt']  = date('Y-m-d H:i:s');
        $data['inquiryIdentify'] = generateUniqueId(16);
        $rules                   = [
            'name'             => 'required|max:100',
            'email'            => 'required|max:150',
            'phone'            => 'required|max:20',
            'eventType'        => 'required|max:100',
            'message'          => '',
            'inquiryCreatedAt' => '',
            'inquiryUpdatedAt' => '',
            'inquiryIdentify'  => 'required|max:50',
        ];
        $validator = new Validator();
        $validator->validate($rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors as $error) {
                echo $error . "</br>";
            }
        } else {
            $inquiriesModel->record($data);
            // success adding and redirect
            header("Location:  " . ROOT . "/admin/inquiries/");
            $_SESSION['success_message'] = "Added successful!";
            exit;
        }
    }

    public function inquiriesModify(Request $request, $inquiriesIdentify)
    {
        $inquiriesModel            = $this->model('inquiriesModel');
        $params['inquiryIdentify'] = $inquiriesIdentify;
        $params['inquiries']       = $inquiriesModel->displaySingle($inquiriesIdentify);
        $this->adminView('inquiries/inquiriesEdit', $params);
    }

    public function inquiriesEdit(Request $request, $inquiriesIdentify)
    {
        $inquiriesModel = $this->model('inquiriesModel');
        $data           = $request->getBody();
        $rules          = [
            'name'             => 'required|max:100',
            'email'            => 'required|max:150',
            'phone'            => 'required|max:20',
            'eventType'        => 'required|max:100',
            'message'          => '',
            'inquiryCreatedAt' => '',
            'inquiryUpdatedAt' => '',
            'inquiryIdentify'  => 'required|max:50',
        ];
        $validator = new Validator();

        if ($validator->fails($rules)) {
            $errors = $validator->errors();
            foreach ($errors as $error) {
                echo $error . "</br>";
            }
        } else {
            $inquiriesModel->modify($data, $inquiriesIdentify);
            // success updated and redirect
            header("Location:  " . ROOT . "/admin/inquiries/");
            $_SESSION['success_message'] = "Update successful!";
            exit;
        }
    }
}
