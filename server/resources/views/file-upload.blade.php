<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Job Batching</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito';
        }

    </style>
</head>

<body class="antialiased">
    <div class="relative  min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0" id="app">
        <div class="w-full absolute top-0 flex justify-center">
            <p class="pt-2 text-3xl dark:text-gray-100 underline">Laravel Job Batching</p>
        </div>
        <div class="absolute flex flex-col items-center justify-center gap-4 inset-0">
            <!-- <div class="w-96 h-64 mt-2 flex items-center border-4 border-dashed rounded-lg"> -->
            <!-- </div> -->
            <section class="">
                <form action="/sales" method="post" enctype="multipart/form-data" class="flex items-center">
                    @csrf
                    <div class="flex w-full h-full items-center justify-center" >
                        <input type="file" name="file" class="w-52 px-0 text-white cursor-pointer border" style="-webkit-box-flex: initial;">
                    </div>
                    <div class="">
                        <button type="submit"
                            class="ml-6 px-4 py-3 bg-purple-500 rounded text-gray-100 font-semibold hover:bg-purple-700 focus:outline-none focus:ring-2 ">Upload</button>
                    </div>
                </form>
            </section>
            <section class="hidden">
                <div class="flex gap-4">
                    <div class="border h-6 w-80 rounded-full overflow-hidden">
                        <div class=" h-full bg-green-500" style="width: 10%;"></div>
                    </div>
                    <div class="text-lg font-semibold text-gray-100"> 10% </div>
                </div>
            </section>
            
        </div>
    </div>
    
</body>

</html>
