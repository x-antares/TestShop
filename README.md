#### How to install TestShop

Install php 7.4

Install MySQL

Install composer

git clone https://github.com/x-antares/TestShop.git folder

cd folder

composer install

define database, APP_KEY in .env

php artisan apikey:generate AppName

php artisan key:generate

php artisan migrate

php artisan db:seed

php artisan serve

#### Rest api doc

Use generated api-key in header to access api

****CATEGORY:****

    Category list:
      - GET|HEAD  | api/categories    
                   
    Show category by id: 
     - GET|HEAD  | api/categories/{category}  
     
    Show products by categoryId:         
     - GET|HEAD  | api/category/{category}/products 
 
 
  ****Orders:****

     Create order:                  
     - POST      | api/orders
     
     Order list:                        
     - GET|HEAD  | api/orders
     
     Show order by id:                      
     - GET|HEAD  | api/orders/{order} 

 ****Products:****
 
     Products list:               
     - GET|HEAD  | api/products    
     
     Show product by id       
     - GET|HEAD  | api/products/{product}    
     
****Auth urls:****      
    
     - GET|HEAD  | login                            
     - POST      | login                                                              
     - POST      | logout                           
     - GET|HEAD  | password/confirm                 
     - POST      | password/confirm                 
     - POST      | password/email                   
     - GET|HEAD  | password/reset                   
     - POST      | password/reset                   
     - GET|HEAD  | password/reset/{token}           
     - GET|HEAD  | register                         
     - POST      | register                         

****Available Only For Auth Users****
   
    **Product**
    
      Delete product by id              
     - DELETE    | api/products/{product} 
      Create product:                   
      - POST      | api/products
      
      Update product by id:                     
      - PUT|PATCH | api/products/{product}  
      
      
      
    **Order**
    
     Update order by id:                      
     - PUT|PATCH | api/orders/{order}  
         
     Delete order by id:                               
     - DELETE    | api/orders/{order}  
     
     
   
     **Category**
     
      Create category:                  
       - POST      | api/categories  
     
     Update category by id:       
      - PUT|PATCH | api/categories/{category} 
            
     Delete category by id:        
      - DELETE    | api/categories/{category}
