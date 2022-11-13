<?php

class Home extends Controller
{

    public function index()
    {
        $data['title'] = 'Home';
        $product = $this->load_model("Product");
        // feathered products
        $data['feathered'] = $product->home_products(
            "SELECT 
                products.id , 
                name , 
                categories.cat_name as cat_name , 
                products.price , 
                products.quantity,
                products.images 
            FROM 
                products 
            JOIN 
                categories 
            ON 
                categories.id=products.category_id 
            WHERE 
                products.quantity > 0 
            AND
            categories.status=1
            ORDER BY 
                rate DESC 
            LIMIT 9"
        );
        // arrival products
        $data['arrivals'] = $product->home_products(
            "SELECT 
                products.id , 
                name , 
                categories.cat_name as cat_name , 
                products.price , 
                products.quantity,
                products.images 
            FROM 
                products 
            JOIN 
                categories 
            ON 
                categories.id=products.category_id 
            WHERE 
                products.status=0 
            AND 
                products.quantity > 0 
            AND
                categories.status=1
            LIMIT 9
        ");
        $this->view("index", $data);
    }
    public function home()
    {
        $this->index();
    }
    public function shop()
    {
        $data['title'] = 'Shop';
        $product = $this->load_model("Product");
        $data['shop'] = $product->home_products(
            "SELECT 
                products.id , 
                name , 
                categories.cat_name as cat_name , 
                products.price , 
                products.quantity,
                products.images 
            FROM 
                products 
            JOIN 
                categories 
            ON 
                categories.id=products.category_id 
            WHERE 
                products.quantity > 0 
            AND
                categories.status=1
            ORDER BY 
                rate 
            DESC
        ");
        $this->view("shop", $data);
    }
    public function product_details($param)
    {
        $param = json_decode($param, true);
        $param = isset($param[2]) ? explode("=", $param[2]) : '';
        if ($param && htmlspecialchars($param[0]) == 'id') {
            $id = filter_var($param[1], FILTER_SANITIZE_NUMBER_INT);
            $prod = $this->load_model("Product");
            $res = $prod->get_product_details($id);
            if ($id && isset($res['data'])) {
                $data['title'] = "Product Details";
                $data['data'] = $res['data'];
                $this->view("product_details", $data);
            }
            else
                header("Location:" . ROOT);
        }
        else
            header("Location:" . ROOT);
    }
}