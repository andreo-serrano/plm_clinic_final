<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <!-- Tailwind CSS CDN link -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

</head>

<body class="relative">

    <div class="overlay absolute inset-0 z-0">
        <img class="w-full h-full object-cover opacity-100" src="{{ asset ('bg_logo/plm_bg.png') }}" alt="Background Image">
    </div>

    <div class="container mx-auto p-6 relative z-10 flex justify-end"> <!-- Add the flex justify-end class here -->
      <div
        class="flex flex-col text-center md:text-left md:flex-row h-screen justify-evenly md:items-center"
      >
        <div class="flex flex-col w-full">
          <div>
            <svg
              class="w-20 h-20 mx-auto md:float-left fill-stroke text-gray-800"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            > 
            </svg>
          </div>
        </div>
    
        <div class="w-full md:w-full lg:w-9/12 mx-auto md:mx-0">
          <div class="bg-white p-10 flex flex-col w-full shadow-xl rounded-xl font-inter" style="border-radius: 30px;">
            <img class="w-full h-full object-cover opacity-100" src="{{ asset ('bg_logo/plm_logo.png') }}" alt="Background Image">
            <div class="mx-auto text-center">
                <h2 class="text-4xl font-bold text-blue-500 mb-5">
                    <br>
                    PLM CLINIC PORTAL
                </h2>
            </div>
           
            <form action="" class="w-full">
              
              
              <div id="button" class="flex flex-col w-full my-5">
                <a href="{{ route('login') }}" class="w-full py-4 bg-blue-600 rounded-lg text-blue-100">
                  <div class="flex flex-row items-center justify-center">
                    <div class="mr-2">
                      <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"
                      ></path>
                    </svg>
                  </div>
                  <div class="font-bold">Login</div>
                </div>
              </a>
            
              <p>
                <br>
              </p>
                
                
              
                  
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

</body>

</html>
