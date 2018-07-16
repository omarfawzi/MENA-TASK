#MENA SOFTWARE TASK

####Setup:
1- composer update <br>
2- create a .env file <br>
3- add the database configuration in the .env file <br>
4- php artisan migrate <br> 
5- php artisan db:seed (optional)

####APIs
HTTP Method | Route | Name | Corresponding Action | Description | PARAMS OR BODY
--- | --- | --- | --- | --- | ---
GET |	api/news | news.index |	App\Http\Controllers\NewsController@index | GET NEWS | 1 - paginate : for page size <br> 2- page : for page no. <br> 3- title : for filter by title <br> 4- title_sign : LIKE <br> 5- date : for filter by date must be in format Y-m-d <br> 6- date_sign : > , < , >= , <= , = <br> 7- sort : asc or desc <br> 8- orderBy[] : date and time / date or time 
POST |	api/news |	news.store |	App\Http\Controllers\NewsController@store | POST SINGLE NEWS | 1- title <br> 2- description <br> 3- text <br> 4- date : Y-m-d format 
GET |	api/news/{$id} |	news.show |	App\Http\Controllers\NewsController@show | SHOW SPECIFIC NEWS
PATCH |	api/news/{$id} |	news.update |	App\Http\Controllers\NewsController@update | UPDATE SPECIFIC NEWS | 1- title <br> 2- description <br> 3- text <br> 4- date : Y-m-d format
DELETE |	api/news/{$id} |	news.destroy |	App\Http\Controllers\NewsController@destroy | DELETE SPECIFIC NEWS
