<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <title>Document</title>
</head>
<body>
    <p>Coucou!</p>
    <h1 x-data="{ message: 'I ❤️ Alpine' }" x-text="message"></h1>

    <div x-data="{ count: 0 }">
        <button x-on:click="count++">Increment</button>
        <span x-text="count"></span>
    </div>  

    
    <div
           x-data="{users: []}"
           x-init="fetch('https://jsonplaceholder.typicode.com/users')
                      .then(response => response.json())
                      .then(data => users = data)">
    <div>
      <!-- begin: user card -->
      <template x-for="user in users">
        <div>
          <div >
            <div>
                <div x-text="user.id"></div>
              <div x-text="user.name"></div>
              <a x-bind:href="'mailto:' + user.email" x-text="user.email"></a>     
              <a  x-bind:href="'https://' + user.website" x-text="user.website"></a>
            </div>
          </div>
        </div>
      </template>
      <!-- end: user card -->
    </div>
</div>



</body>
</html>

