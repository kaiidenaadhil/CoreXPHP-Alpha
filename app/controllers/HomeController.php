<?php

class HomeController extends Controller
{
    public function index()
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

