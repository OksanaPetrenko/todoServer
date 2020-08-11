## Description: 
Server is written on Laravel and is used for processing and storing the data from the app, that is supposed for managing tasks. There the API methods are implemented.

You can send and receive the data from the server only with a token. For this, there are the registration and authorization methods on the server. For the implementation of these methods the Laravel passport service package was used. 
## On the server such API methods are available: 
- registration 
- authorization 
- exit 
- get one task 
 - get all tasks (on receiving all the tasks only those are picked that belonged to the authorized used and are sorted out by priority)
- edit task 
- delete the task 
All methods have the validation.
