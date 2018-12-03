# Backend developer task for mailer lite

Small test app for Mailer Lite [![N|Solid](https://app.mailerlite.com/assets/images/favicons/favicon-32x32.png)](https://www.mailerlite.com/)

Original requirement can be found here [here](https://gist.github.com/justinasposiunas/52f3c130c969834373dceae54d6b06fd)

### Preinstall
    This app is based on the laravel framework. It has the same requirements as [it](https://laravel.com/docs/5.7/installation#server-requirements)
    Configure your db connection in .env
    
### Installation
```sh
$git clone https://github.com/KIvanow/mailerLiteProject.git
$cd mailerLiteProject
$php artisan migrate
$php artisan db:seed
```

### Running it
To simply run it:
```sh
$php artisan serve
```

To rebuild js/css and run it:
```sh
$npm run dev; php artisan serve
```
Then open http://localhost:8000 to see it in action

### Running the tests
```sh
$composer test
```

### Seeded users
user@example.com / password -> to see the regular user view
admin@example.com / password -> to see the admin view

### API endpoints
**Get Subscriber**
----
  Returns json data about a single subscriber.
* **URL**
  api/subscribers/:id
* **Method:**
  `GET`
*  **URL Params**
   **Required:**
   `id=[integer]`
* **Data Params**
  None
* **Success Response:**
  * **Code:** 200 <br />
    **Content:** `{ id : 12, name : "Michael Bloom", email: "michaelbloom@gmail.com", "fields": array[], "user_id" }`
* **Error Response:**
  * **Code:** 422 422 (Unprocessable Entity) <br />
    **Content:** `errors: { additional errors for every field },
        message: "The given data was invalid."`
* **Sample Call:**
  ```javascript
    $.ajax({
      url: "/subscribers/1",
      dataType: "json",
      type : "GET",
      success : function(r) {
        console.log(r);
      }
    });
  ```
  
**Get All Subscribers**
----
  Returns json data about all subscribers.
* **URL**
  api/subscribers/
* **Method:**
  `GET`
* **Data Params**
  None
* **Success Response:**
  * **Code:** 200 <br />
    **Content:** `{ id : 12, name : "Michael Bloom", email: "michaelbloom@gmail.com", "fields": array[], "user_id" }`
* **Error Response:**
  * **Code:** 422 (Unprocessable Entity) <br />
    **Content:** `errors: { additional errors for every field },
        message: "The given data was invalid."`
* **Sample Call:**
  ```javascript
    $.ajax({
      url: "/subscribers",
      dataType: "json",
      type : "GET",
      success : function(r) {
        console.log(r);
      }
    });
  ```
**Edit Subscriber**
----
  Returns json data about all subscribers.
* **URL**
  api/subscribers/:id
* **Method:**
  `PUT`
* **Data Params**
  object with values to be changed
* **Success Response:**
  * **Code:** 200 <br />
    **Content:** `[{ id : 12, name : "Michael Bloom", email: "michaelbloom@gmail.com", "fields": array[], "user_id" }]`
* **Error Response:**
  * **Code:** 422 (Unprocessable Entity) <br />
    **Content:** `errors: { additional errors for every field },
        message: "The given data was invalid."`
* **Sample Call:**
  ```javascript
    $.ajax({
      url: "/subscribers",
      dataType: "json",
      type : "PUT",
      success : function(r) {
        console.log(r);
      }
    });
  ```
  
**Create Subscriber**
----
  Create entry about new subscriber
* **URL**
  api/subscribers/
* **Method:**
  `POST`
* **Data Params**
  email, name, user_id
* **Success Response:**
  * **Code:** 200 <br />
    **Content:** `{ id : 12, name : "Michael Bloom", email: "michaelbloom@gmail.com", "fields": array[], "user_id" }`
* **Error Response:**
  * **Code:** 422 (Unprocessable Entity) <br />
    **Content:** `errors: { additional errors for every field },
        message: "The given data was invalid."`
* **Sample Call:**
  ```javascript
    $.ajax({
      url: "/subscribers",
      dataType: "json",
      data: {
          name: "Michael Bloom",
          email: "michaelbloom@gmail.com",
          user_id: 1
      }
      type : "POST",
      success : function(r) {
        console.log(r);
      }
    });
  ```
  
**Delete Subscriber**
----
  Delete the entry about the given subscriber
* **URL**
  api/subscribers/:id
* **Method:**
  `DELETE`
*  **URL Params**
   **Required:**
   `id=[integer]`
* **Data Params**
  None
* **Success Response:**
  * **Code:** 200
* **Error Response:**
  * **Code:** 422 (Unprocessable Entity) <br />
    **Content:** `errors: { additional errors for every field },
        message: "The given data was invalid."`
* **Sample Call:**
  ```javascript
    $.ajax({
      url: "/subscribers/1",
      dataType: "json",
      type : "DELETE",
      success : function(r) {
        console.log(r);
      }
    });
  ```
  
**Get Field**
----
  Returns json data about a single field.
* **URL**
  api/fields/:id
* **Method:**
  `GET`
*  **URL Params**
   **Required:**
   `id=[integer]`
* **Data Params**
  None
**Content:** `{ id : 12, title : "joinedAt", value: "1983-05-25", "type": "date", "subscriber_id": 1 }`
* **Error Response:**
  * **Code:** 422 (Unprocessable Entity) <br />
    **Content:** `errors: { additional errors for every field },
        message: "The given data was invalid."`
* **Sample Call:**
  ```javascript
    $.ajax({
      url: "/fields/1",
      dataType: "json",
      type : "GET",
      success : function(r) {
        console.log(r);
      }
    });
  ```
  
**Get Subscribers Fields**
----
  Returns json array with the fields of a given user.
* **URL**
  api/fields/getSubscriberFields/:subscriber_id
* **Method:**
  `GET`
*  **URL Params**
   **Required:**
   `id=[integer]`
* **Data Params**
  None
**Content:** `[{ id : 12, title : "joinedAt", value: "1983-05-25", "type": "date", "subscriber_id": 1 }...]`
* **Error Response:**
  * **Code:** 422 (Unprocessable Entity) <br />
    **Content:** `errors: { additional errors for every field },
        message: "The given data was invalid."`
* **Sample Call:**
  ```javascript
    $.ajax({
      url: "/fields/getSubscriberFields/1",
      dataType: "json",
      type : "GET",
      success : function(r) {
        console.log(r);
      }
    });
  ```
  
**Create Field**
----
  Create new field entry
* **URL**
  api/fields/
* **Method:**
  `POST`
* **Data Params**
  `title, value, type, subscriber_id`
**Content:** `[{ id : 12, title : "joinedAt", value: "1983-05-25", "type": "date", "subscriber_id": 1 }...]`
* **Error Response:**
  * **Code:** 422 (Unprocessable Entity) <br />
    **Content:** `errors: { additional errors for every field },
        message: "The given data was invalid."`
* **Sample Call:**
  ```javascript
    $.ajax({
      url: "/fields/1",
      dataType: "json",
      data{
          title: "joinedAt",
          value: "1983-05-25",
          type: "date",
          "subscriber_id": 1
      }
      type : "POST",
      success : function(r) {
        console.log(r);
      }
    });
  ```
  
 
**Edit Field**
----
  Edit the entry for a given field
* **URL**
  api/fields/:id
*  **URL Params**
   **Required:**
   `id=[integer]`
* **Method:**
  `PUT`
* **Data Params**
  `title, value, type, subscriber_id`
**Content:** `[{ id : 12, title : "joinedAt", value: "1983-05-30", "type": "date", "subscriber_id": 1 }...]`
* **Error Response:**
  * **Code:** 422 422 (Unprocessable Entity) <br />
    **Content:** `errors: { additional errors for every field },
        message: "The given data was invalid."`
* **Sample Call:**
  ```javascript
    $.ajax({
      url: "/fields/getSubscriberFields/1",
      dataType: "json",
      data{
          title: "joinedAt",
          value: "1983-05-30",
          type: "date",
          "subscriber_id": 1
      }
      type : "PUT",
      success : function(r) {
        console.log(r);
      }
    });
  ```
  
**Delete Field**
----
  Delete the given field entry
* **URL**
  api/fields/:id
*  **URL Params**
   **Required:**
   `id=[integer]`
* **Method:**
  `DELETE`
* **Data Params**
  NONE
**Content:** 
    * **Code:** 200
* **Error Response:**
  * **Code:** 422 (Unprocessable Entity) <br />
    **Content:** `errors: { additional errors for every field },
        message: "The given data was invalid."`
* **Sample Call:**
  ```javascript
    $.ajax({
      url: "/fields/1",
      dataType: "json",
      type : "DELETE",
      success : function(r) {
        console.log(r);
      }
    });
  ```
  
**Shorthand API endpoints**
    Simillar to PUT request request with changed state of the subscriber
    subscribers/activate/:id
    subscribers/unsubscribe/:id
    subscribers/junk/:id
    subscribers/unconfirm/:id
    subscribers/bounce/:id
    
### Todos
 - Add tests for the shorthand user status change API
 - Add Subscriber edtting form to show the way fields can be editted
 - Convert the simple js rendering of the tables to vue.js with thread to make asynchronous updates
 - Better authentication on requests
 - Tests for the UI
