<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
				padding: 10px;
                
                display: flex;
               
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: left;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
			
				<p>1. Метод для создания товарной группы</p>
			    <form action="http://localhost/todo/public/api/good_groups/add" method="post">
				  <input name="name" type="text" value="test" />  
				  <input type="submit" />
				</form>	
				
				<p>2. Метод для получения списка товарных групп</p>
				<form action="http://localhost/todo/public/api/good_groups" method="get" >
				  <input type="submit" />
				</form>	
							
				<p>3. Метод для обновления товарной группы</p>
				<form action="http://localhost/todo/public/api/good_groups/update" method="post">
				<input type="hidden" name="_method" value="PUT">
				  <input name="old_name" type="text" value="test" />  
				  <br/>
				  <input name="new_name" type="text" value="test3" />  
				  <input type="submit" />
				</form>	
				
				<p>4. Метод для удаления товарной группы</p>
				<form action="http://localhost/todo/public/api/good_groups/delete" method="post">
				  <input type="hidden" name="_method" value="DELETE">
				  <input name="name" type="text" value="test"/>  
				  <input type="submit" />
				</form>	
				
				<p>5. Метод для создания товара.</p>
				<form action="http://localhost/todo/public/api/goods/add" method="post">
				  <input name="name" type="text" value="test" />  
				  <input name="description" type="text" value="test description" /> 
				  <input name="price" type="text" value="12.43" />  
				  <input name="group_id" type="number" min="1" value="1" />  				  
				  <input type="submit" />
				</form>
				
				<p>6. Метод для получения всех товаров.</p>
				<form action="http://localhost/todo/public/api/goods" method="get" >
				  <input type="submit" />
				</form>	
				
				<p>7. Метод для получения конкретного товара</p>
			    <form action="http://localhost/todo/public/api/goods/good" method="get">
				  <input name="name" type="text" value="test" />  
				  <input type="submit" />
				</form>	
				
				<p>8. Метод для получения товаров конкретной товарной группы</p>
			    <form action="http://localhost/todo/public/api/goods/group" method="get">
				  <input name="name" type="text" value="test" />  
				  <input type="submit" />
				</form>	
				
				<p>9. Метод для обновления данных товара</p>
				<form action="http://localhost/todo/public/api/goods/update" method="post">
				  <input type="hidden" name="_method" value="PUT">
				  <input name="old_name" type="text" value="test" />
				  <br/>				  
				  <input name="new_name" type="text" value="test2" />  
				  <input name="description" type="text" value="test description" /> 
				  <input name="price" type="text" value="6.92" />  				  
				  <input type="submit" />
				</form>
				
				<p>10. Метод для удаления товара</p>
				<form action="http://localhost/todo/public/api/goods/delete" method="post">
				  <input type="hidden" name="_method" value="DELETE">
				  <input name="name" type="text" value="test" />  
				  <input type="submit" />
				</form>
				
                <div class="title m-b-md">
                    Laravel 5.4
                </div>

               
            </div>
        </div>
    </body>
</html>
