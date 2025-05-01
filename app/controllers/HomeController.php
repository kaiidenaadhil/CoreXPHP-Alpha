<?php

class HomeController extends Controller
{
    
    public function index() {
        $result = $this->model('OrderModel')->truncate();
    
        echo $result !== false ? '✅ Orders table truncated' : '❌ Truncate failed';
    }
    

    // public function index() {
    //     $deleted = $this->model('LeadModel')->delete(52);
    
    //     echo $deleted ? '✅ Lead deleted successfully' : '❌ Delete failed';
    // }
    

    // public function index() {
    //     $leads = $this->model('LeadModel')->all();
    
    //     foreach ($leads as $lead) {
    //         echo $lead->name . " - " . $lead->email . "<br>";
    //     }
        
    // }
    
    


    // public function index() {
    //     $lead = $this->model('LeadModel')
    //         ->findAll()
    //         ->select(['name', 'email', 'status'])
    //         ->where('status', 'lost')
    //         ->orderBy('createdAt', 'desc')
    //         ->first();
    
    //     print_r($lead);
    // }

    
    // public function index() {
    //     $lead = $this->model('LeadModel')
    //         ->findAll() // get the QueryBuilder
    //         ->where('status', 'lost')
    //         ->orderBy('createdAt', 'desc')
    //         ->first();
    //         print_r($lead);
    // }
    
    
    // public function index() {
    //     $lead = $this->model('LeadModel')->find(52);
    
    //     if ($lead) {
    //         $lead->status = 'new';
    //         $lead->serviceInterested = 'UI/UX Design';
    
    //         $saved = $lead->save();
    //         echo $saved ? '✅ Lead updated via save()' : '❌ Failed to save lead';
    //     } else {
    //         echo '❌ Lead not found';
    //     }
    // }

    
    // public function index() {
    //     $lead = $this->model('LeadModel')->find(52);
    
    //     if ($lead) {
    //         echo $lead->toJson(); // or: print_r($lead->toArray());
    //     } else {
    //         echo '❌ Lead not found';
    //     }
    // }
    
    

    
    // public function index() {
    //     $updated = $this->model('LeadModel')->update([
    //         'status' => 'converted',
    //         'serviceInterested' => 'Mobile App Development'
    //     ], 52);
    
    //     echo $updated ? '✅ Update succeeded' : '❌ Update failed';
    // }

    

    // public function index() {
    //     $created = $this->model('LeadModel')->create([
    //         'name' => 'Bruce Wayne',
    //         'email' => 'bruce@batman.com',
    //         'phone' => '01999999999',
    //         'serviceInterested' => 'Vigilante Training',
    //         'status' => 'new',
    //         'createdAt' => date('Y-m-d H:i:s'),
    //     ]);
    
    //     echo $created ? '✅ Created successfully' : '❌ Create failed';
    // }
    
    


    // public function ind0ex() {
    //     $data = $this->model('OrderModel')
    //         ->findAll()
    //         ->selectRaw('status, COUNT(*) AS order_count')
    //         ->groupBy('status')
    //         ->having('order_count', '>', 1)
    //         ->get();
    
    //     echo json_encode($data, JSON_PRETTY_PRINT);
    // }
    
    
    
    // public function index_aggregate() {
    //     $orderModel = $this->model('OrderModel')->findAll()->where('status', 'paid');
    
    //     $count = $orderModel->count();
    //     $sum   = $orderModel->sum('amount');
    //     $avg   = $orderModel->avg('amount');
    //     $min   = $orderModel->min('amount');
    //     $max   = $orderModel->max('amount');
    
    //     echo json_encode([
    //         'count' => $count,
    //         'sum'   => $sum,
    //         'avg'   => $avg,
    //         'min'   => $min,
    //         'max'   => $max
    //     ], JSON_PRETTY_PRINT);
    // }
    
    
    // public function inddcex(){

    //     $data = $this->model('LeadModel')
    //     ->findAll([
    //         'filters' => ['status' => 'lost'],
    //         'search' => ['term' => 'emma', 'columns' => ['name']],
    //         'pagination' => ['enabled' => true, 'page' => 1, 'perPage' => 2],
    //         'sort' => ['column' => 'createdAt', 'direction' => 'asc']
    //     ])
    //     ->groupBy('serviceInterested')
    //     ->having('COUNT(leadId)', '>', 1)
    //     ->get();
    
    // if (isset($data['data'])) {
    //     echo json_encode($data['meta'], JSON_PRETTY_PRINT);
    //     echo json_encode($data['data'], JSON_PRETTY_PRINT);
    // } else {
    //     echo json_encode($data, JSON_PRETTY_PRINT);
    // }
    
    // }
    
    // public function indejx()
    // {
    //     // $data = $this->model('DummyModelWithTable')
    //     // ->findAll([
    //     //     'filters' => ['status' => 'lost'],
    //     //    'search' => ['term' => 'Momoa', 'columns' => ['name']],
    //     //     'pagination' => ['enabled' => true, 'page' => 1, 'perPage' => 10],
    //     //     'sort' => ['column' => 'createdAt', 'direction' => 'asc']
    //     // ]);
    
    //     $data = $this->model('LeadModel')->findAll([
    //         'filters' => ['status' => 'lost']
    //     ]);
        
    //     // Check for paginated result
    //     if (isset($data['data']) && isset($data['meta'])) {
    //         echo json_encode($data, JSON_PRETTY_PRINT);
    //     } else {
    //         echo json_encode($data->get(), JSON_PRETTY_PRINT);
    //     }
        
        
    // }
    
    
    
    
    // public function index()
    // {
    //     // Load the UserModel
    //     $userModel = $this->model('UserModel');

    //     // Find specific user
    //     $user = $userModel->find(4);

    //     // Get related data
    //     $projects = $user ? $user->projects() : [];
    //     $subscriptions = $user ? $user->subscriptions() : [];
    //     $orders = $user ? $user->orders() : [];

    //     return $this->view('index', [
    //         'user' => $user,
    //         'projects' => $projects,
    //         'subscriptions' => $subscriptions,
    //         'orders' => $orders
    //     ]);
    // }
}

