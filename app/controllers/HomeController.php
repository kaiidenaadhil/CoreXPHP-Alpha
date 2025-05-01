<?php

class HomeController extends Controller
{
    public function index(){


        $data = $this->model('LeadModel')
        ->findAll()
        ->select(['status', 'COUNT(*)'])
        ->groupBy('status')
        ->get();                          // Get the results

    if (isset($data['data'])) {
        echo json_encode($data['meta'], JSON_PRETTY_PRINT);
        echo json_encode($data['data'], JSON_PRETTY_PRINT);
    } else {
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
    
    }
    
    public function indejx()
    {
        // $data = $this->model('DummyModelWithTable')
        // ->findAll([
        //     'filters' => ['status' => 'lost'],
        //    'search' => ['term' => 'Momoa', 'columns' => ['name']],
        //     'pagination' => ['enabled' => true, 'page' => 1, 'perPage' => 10],
        //     'sort' => ['column' => 'createdAt', 'direction' => 'asc']
        // ]);
    
        $data = $this->model('LeadModel')->findAll([
            'filters' => ['status' => 'lost']
        ]);
        
        // Check for paginated result
        if (isset($data['data']) && isset($data['meta'])) {
            echo json_encode($data, JSON_PRETTY_PRINT);
        } else {
            echo json_encode($data->get(), JSON_PRETTY_PRINT);
        }
        
        
    }
    
    
    
    
    public function indexi()
    {
        // Load the UserModel
        $userModel = $this->model('UserModel');

        // Find specific user
        $user = $userModel->find(4);

        // Get related data
        $projects = $user ? $user->projects() : [];
        $subscriptions = $user ? $user->subscriptions() : [];
        $orders = $user ? $user->orders() : [];

        return $this->view('index', [
            'user' => $user,
            'projects' => $projects,
            'subscriptions' => $subscriptions,
            'orders' => $orders
        ]);
    }
}

