<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images\IIT Kanpur Icon Logo.ico" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="{{asset('style-layout.css')}}">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
        <script>
            $(document).ready(function(){
                var $mainHeading=$(".security");
                var report=$(".report");
                function fadeInHeading() {
                    $mainHeading.removeClass("invisible");
                $mainHeading.css('opacity',1); // Fade in over 1 second (1000 milliseconds)
            }
            function fadeInreport() {
                    report.removeClass("invisible");
                report.css('opacity',1); // Fade in over 1 second (1000 milliseconds)
            }
            // Set a timeout to call the fadeInHeading function after 1 second (1000 milliseconds)
            setTimeout(fadeInHeading, 500); // 1000 milliseconds = 1 second  #JS dono functions ko ek saath queue krega
            setTimeout(fadeInreport, 1000);
            setTimeout(function(){
                var typed = new Typed(".auto-type", {
strings: ["This portal is for security purposes of IITK."],
typeSpeed: 50
});
            }, 1200);
           
            });
        
            function openModal() {
                document.getElementById('attachmentModal').style.display = 'block';
                document.getElementById('overlay').style.backgroundColor = 'rgba(0, 0, 0, 0.5)'; 
            }
        
            function closeModal() {
                document.getElementById('attachmentModal').style.display = 'none';
                document.getElementById('overlay').style.backgroundColor = 'rgba(0, 0, 0, 0)'; 
            }
            function openModal1() {
                document.getElementById('deleteModal').style.display = 'block';
                document.getElementById('overlay').style.backgroundColor = 'rgba(0, 0, 0, 0.5)'; 
            }
            function closeDeleteModal() {
                document.getElementById('deleteModal').style.display = 'none';
                document.getElementById('overlay').style.backgroundColor = 'rgba(0, 0, 0, 0)'; 
            }
            function openModalI() {
                document.getElementById('infoModal').style.display = 'block';
                document.getElementById('overlay').style.backgroundColor = 'rgba(0, 0, 0, 0.5)'; 
            }
        
            function closeModalI() {
                document.getElementById('infoModal').style.display = 'none';
                document.getElementById('overlay').style.backgroundColor = 'rgba(0, 0, 0, 0)'; 
            }
        </script>
        <script>
            tailwind.config = {
                theme: {
                    screens: {
      sm: '480px',
      md: '768px',
      lg: '976px',
      xl: '1440px',
      },
                    extend: {
                        fontFamily: {
                         "seriff": ['Playfair Display', 'serif'],
                        },
                        colors: {
                            laravel: "#ef3b2d",
                        },
                    },
                },
            };
        </script>
        <title>Security | IIT Kanpur</title>
    </head>
    <body class="mb-48">
        <nav class=" flex justify-between items-center mb-2">
            <div class="flex items-center">
            <a href="/"
                ><img class="w-14 mx-2 mt-2" src="{{asset('images\security_logo.png')}}" alt="" class="logo"    {{--you can use asset to show public things--}}
            /></a>
            <span class="font-seriff md:text-3xl text-2xl">IITK</span>
        </div>
            <ul class="flex items-center space-x-6 mr-6 ">
                @auth               {{--Jab logged in hai to ye dikhao--}}
                <li>
                    <span class='hidden md:block md:font-bold uppercase underline underline-offset-4 text-base'>Welcome {{auth()->user()->name}}</span>
                </li>
                <li class="py-2 md:px-5 px-3 text-white bg-black rounded-full text-sm">
                    <a href="/listings/manage" class=" hover:text-gray-400"
                        ><i class="fa-solid fa-gear"></i>
                        Manage Reports</a
                    >
                </li>
                <li class="py-2 md:px-5 px-3 text-white bg-black rounded-full text-sm">
                    <form class="inline" method="POST" action="/logout">
                    @csrf
                    <button type="submit" class=" hover:text-gray-400">
                    <i class="fa-solid fa-door-closed"></i> Logout
                    </button>
                    </form>
                    </li>
                @else
                <li >
                    <button class="rl relative px-2.5 py-1.5 text-base bg-blue-500 rounded-sm">
                    <a href="/register" class=" text-white "
                        ><i class="fa-solid fa-user-plus"></i> Register</a
                    >
                </button>
                </li>
                <li>
                    <button class="rl relative px-2.5 py-1.5 text-base bg-blue-500 rounded-sm">
                    <a href="/login" class=" text-white "
                        ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                        Login</a
                    >
                </button>
                </li>
                @endauth
            </ul>
        </nav>
    {{-- VIEW OUTPUT                   The <main> tag specifies the main content of a document.  --}}
        <main class="m-0">
   {{$slot}}
        </main>
        <footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-gradient-to-t from-black to-gray-300 text-white h-16 mt-24 opacity-90 md:justify-center"
    >
        <p class="text-xs md:text-base ml-2">Copyright &copy; 2024, All Rights reserved</p>
        @auth
<div class="h-full absolute right-10 flex flex-col justify-center items-center">
        <a
            href="/listings/create"
            class="bg-red-600 text-white py-2 px-5 hover:bg-red-700"
            >New Report</a >
</div>
@endauth
    </footer>
    <x-flash-message />
</body>
</html>
