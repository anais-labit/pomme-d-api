<nav class="bg-[#5A945B] text-[18px] text-white flex flex-row justify-between h-16">
    <div class="mx-5 my-4 ">
        <img src="public/img/logo.png" alt="logo" class="h-28 w-28 rounded-xl border-2 border-black">
    </div>
    <div class="flex flex-row gap-6 justify-end  my-5 mx-5">

        <div x-data="{ loginData: '', registerData: '', loginOpen: false, registerOpen: false }">
            <button class="mr-2" x-on:click="
                fetch('login')
                .then(response => response.text())
                .then(data => loginData = data)
                registerOpen = false;
            " @click="loginOpen = !loginOpen">Login</button>
            <button x-on:click="
                fetch('register')
                .then(response => response.text())
                .then(data => registerData = data)
                loginOpen = false;
            " @click="registerOpen = !registerOpen">Register</button>
            <div class="absolute right-0 top-16" x-show="loginOpen" @click.outside="loginOpen = false" x-html="loginData" x-transition.opacity></div>
            <div class="absolute right-0 top-16" x-show="registerOpen" @click.outside="registerOpen = false" x-html="registerData" x-transition.opacity></div>

        </div>
    </div>
</nav>