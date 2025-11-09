config/app.php
During local development, you should set the APP_DEBUG environment variable to true.
In your production environment, this value should always be false.

{{--  --}}
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Throwable;
  try {}
  catch (ValidationException $e){}
  catch (QueryException $e){}
  catch (Throwable $e) {}

{{--  --}}
{{-- AJAX TEMPLATE --}}
// 1056 7605 60001
$.ajax({
  url: 'your_api_endpoint', // The URL to which the request is sent
  type: 'GET', // or 'POST', 'PUT', 'DELETE', etc.
  data: { // Data to be sent to the server (for POST/PUT requests)
    key1: 'value1',
    key2: 'value2'
  },
  dataType: 'json', // Expected data type from the server response (e.g., 'json', 'xml', 'html', 'text')
  success: function(response) {
    // Function to execute if the request succeeds
    console.log('Success:', response);
  },
  error: function(jqXHR, textStatus, errorThrown) {
    // Function to execute if the request fails
    console.error('Error:', textStatus, errorThrown);
  }
});

{{-- PHP/MySQL	                        Laravel Eloquent/Query Builder --}}

mysqli_query($conn, $sql)	              Employee::all() 
mysqli_fetch_assoc	                    $employee->toArray() or direct property $employee->name
prepare & bind_param	                  Eloquent mass assignment (create) or Query Builder with arrays
Manual pagination logic	                $employees = Employee::paginate(5)
Manual DB connection	                  Configured via .env automatically           
$conn = new mysqli(...)                 .env auto-config + Employee::all()        
prepare() + bind_param()                Employee::create([...]) or ->update([...])
fetch_all(MYSQLI_ASSOC)                 Employee::all()                             
password_hash() / password_verify()     Hash::make() / Hash::check()              
Manual pagination                       Model::paginate(5)                       
$_SESSION['username']                   session(['username'=>...])                   

{{-- Ideal pass format :  --}}
'password' => [
    'required',
    'string',
    'confirmed',        // matches password_confirmation field
    'min:8',            // minimum 8 characters
    'max:30',           // maximum 30 characters
    'regex:/[a-z]/',    // must contain at least one lowercase letter
    'regex:/[A-Z]/',    // must contain at least one uppercase letter
    'regex:/[0-9]/',    // must contain at least one number
    'regex:/[@$!%*#?&]/' // must contain a special character
],


{{-- Aspect	                            Eloquent ORM	             Raw SQL --}}

Relationship handled automatically	    Yes	                         No
SQL injection protection	            Automatic	                 Only if you use bindings
Code readability	                    High	                     Low
Adaptability (column rename, etc.)	    Model only	                 Fix every query
Return type	                            Collection of Models	     Array of stdClass objects
Maintenance effort	                    Low	                         High
Debugging	                            Built-in logging	         Manual print_r or dd()

In production, make sure: you don’t expose debug info (APP_ DEBUG=false in .env)
                          You use proper error handling (no stack traces)