<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      text-align: center;
      padding-top: 100px;
    }

    .welcome-box {
      background-color: white;
      padding: 40px;
      border-radius: 10px;
      display: inline-block;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #333;
    }

    button.logout-btn {
      margin-top: 30px;
      padding: 10px 20px;
      font-size: 16px;
      background-color: #e74c3c;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button.logout-btn:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>

  <div class="welcome-box">
    <h1>Welcome, {{auth()->user()->name}}!</h1>
    <p>We're glad to see you here.</p>

    <form  method="post" action="{{route('logout')}}">
    @csrf   
    <button type="submit" class="logout-btn">Logout</button>

    </form>
  </div>



</body>
</html>
