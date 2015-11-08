<?php

// src/Controller/ArticlesController.php

namespace App\Controller;

class OrdersController  extends AppController
{
    public function admin()
    {
        $orders = $this->Orders->find('all');
        $this->set(compact('orders'));
    }
    
    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The Order with id: {0} has been deleted.', h($id)));
            return $this->redirect(['action' => 'admin']);
        }
    }
    
    public function complete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $order = $this->Orders->get($id);
        $order['status'] = "Completed";
        if ($this->Orders->save($order)) {
            $this->Flash->success(__('The Order with id: {0} has been marked as complete.', h($id)));
            return $this->redirect(['action' => 'admin']);
        }
    }
    public function login()
    {
        if ($this->request->is('post')) {
            $login = $this->request->data;
//            print_r($login);
            if($login['username'] == 'admin' && $login['password'] == 'conestoga'){
                    $this->Flash->success(__('Successfully Logged In.'));
                    return $this->redirect(['action' => 'admin']);
                }
            
            $this->Flash->error(__('Please Enter Right Credentials.'));
        }
    }
    
     public function view($id)
    {
        $order = $this->Orders->get($id);
        $this->set(compact('order'));
    }

    public function index()
    {
        $order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
        $tempOrder = $this->request->data;
                if(empty($tempOrder['toppings1']) && empty($tempOrder['toppings2']))
                    {
                    $this->Flash->success(__('Please Select atleast 1 topping.'));
                    return $this->redirect(['action' => 'index']);
                }else{
                    if(empty($tempOrder['toppings1'])){
                        $toppings = $tempOrder['toppings2'];
                    }else if(empty($tempOrder['toppings2'])){
                        $toppings = $tempOrder['toppings1'];
                    }else{
                        $toppings = null;
                    }

                     $toppingsCount=0;
                    if($toppings != null)
                    {
                    $toppingsCount = count($toppings);
                    $toppings = implode(",", $toppings);
                    }
                    $tempOrder['toppings'] = $toppings;
                    unset($tempOrder['toppings1']);
                    unset($tempOrder['toppings2']);

                    $finalBill = 0;
                    $sizeCost = 0;
                    $toppingsCost = 0;
                    $crustCost = 0;
                    $taxValue = 1;
                    $tax = $tempOrder['province'];
                    switch($tax)
                    {
                        case "ontario":
                            $taxValue = 13;
                            break;
                        case "quebec":
                            $taxValue = 15;
                            break;
                        case "saskatchewan":
                            $taxValue = 10;
                            break;
                        case "alberta":
                            $taxValue = 5;
                            break;
                        default:
                            $taxValue = 1;
                            break;
                    }


                    $size = $tempOrder['size'];
                    switch($size)
                    {
                        case "small":
                            $sizeCost = 5;
                            break;
                        case "medium":
                            $sizeCost = 10;
                            break;
                        case "large":
                            $sizeCost = 15;
                            break;
                        case "extraLarge":
                            $sizeCost = 20;
                            break;
                        default:
                            $sizeCost = 0;
                            break;
                    }

                    $crust = $tempOrder['crust'];
                    switch($crust)
                    {
                        case "stuffed":
                            $crustCost = 2;
                            break;
                        default:
                            $crustCost = 0;
                            break;
                    }

                    $toppingsCost = $toppingsCount * 0.5;

                    $finalBill = $sizeCost + $toppingsCost + $crustCost;
                    $finalBill = $finalBill + ($finalBill*$taxValue/100);

                    $tempOrder['billAmount'] = $finalBill;

                    $order = $this->Orders->patchEntity($order, $tempOrder);

                    if ($this->Orders->save($order)) {
                        $this->Flash->success(__('Your order has been saved. Bill Amount = $'.$finalBill));
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('Unable to add your order.'));
                    }
            }
           
        $this->set('order', $order);
           
    }
    
  
}
?>