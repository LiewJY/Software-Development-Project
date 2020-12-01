@extends('layouts.page')

@section('content')
   <section class="text-gray-700 body-font relative bg-gray-100">
    <!-- Title -->
    <div class="container px-5 py-10 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
      <h1 class="font-serif sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900 underline">CONTACT US</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
        Come & experience our inviting spaces for yourself as we offer the best workspace solutions for every office need. Ready to move-in office space located in prime locations across the Klang Valley equipped with the finest business amenities for you and your team!
      </p>
    </div>

    <!-- Map Location -->
    <div class="container px-5 py-5 mx-auto flex sm:flex-no-wrap flex-wrap">
    <div class="lg:w-2/3 md:w-2/3 bg-gray-300 rounded-lg overflow-hidden sm:mr-20 p-20 flex items-end justify-start relative">
      <iframe 
        width="100%" height="100%" class="absolute inset-0" frameborder="0" title="map" marginheight="0" marginwidth="0" scrolling="no" 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31873.174810067398!2d101.68298123955077!3d3.055345399999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4abb795025d9%3A0x1c37182a714ba968!2sAsia%20Pacific%20University%20of%20Technology%20%26%20Innovation%20(APU)!5e0!3m2!1sen!2smy!4v1594444871313!5m2!1sen!2smy" 
        style="filter: contrast(1.2) opacity(0.7);">
      </iframe>
    </div>

    <!-- Table -->
    <div class="lg:w-1/3 md:w-1/2 flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
      <h2 class="font-serif text-gray-900 text-lg mb-1 font-medium title-font underline">Details</h2>
      <p class="leading-relaxed mb-0 text-gray-600">Further inquires, please contact us at:</p>
      <p class="leading-relaxed mb-0 text-gray-600">Phone: <a class="text-indigo-500 leading-relaxed hover:underline" href="tel:+03-8996 1000">03-8996 1000</a></p>
      <p class="leading-relaxed mb-5 text-gray-600">Email: <a class="text-indigo-500 leading-relaxed hover:underline" href="ShareSpace@hotmail.com">ShareSpace@hotmail.com</a></p>
      <div class="relative mb-4">
        <h2 class="font-serif text-gray-900 text-lg mb-1 font-medium title-font underline">Operating Hours</h2>
        <table class="table-fixed border-collapse border border-gray-800">
          <tr>
                            <th class="w-1/4 border border-gray-600">Day</th>
                            <th class="w-1/2 border border-gray-600">Time</th>
          </tr>
          <tr>
            <td class="border border-gray-600">Monday</td>
            <td class="border border-gray-600">9am - 9pm</td>
          </tr>
          <tr>
            <td class="border border-gray-600">Tuesday</td>
            <td class="border border-gray-600">9am - 9pm</td>
          </tr>
          <tr>
            <td class="border border-gray-600">Wednesday</td>
            <td class="border border-gray-600">9am - 9pm</td>
            </tr>
          <tr>
            <td class="border border-gray-600">Thursday</td>
            <td class="border border-gray-600">9am - 9pm</td>
          </tr>
          <tr>
            <td class="border border-gray-600">Friday</td>
            <td class="border border-gray-600">9am - 9pm</td>
          </tr>
          <tr>
            <td class="border border-gray-600">Saturday</td>
            <td class="border border-gray-600">9am - 9pm</td>
          </tr>
          <tr>
            <td class="border border-gray-600">Sunday</td>
            <td class="border border-gray-600">Closed</td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  </div>
</section>
<section class="text-gray-700 body-font relative bg-gray-200">
    <!-- Gallery -->
  <div class="container px-5 py-5 mx-auto">
    <div class="flex flex-col text-center w-full mb-1">
      <h1 class="font-serif sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900 underline">GALLERY</h1>
    </div>
  </div> 

    <!-- Picture -->
  <div class="container mx-auto flex flex-col px-5 py-0 justify-center items-center">
    <div class="flex flex-wrap md:-m-2 -m-1">
      <div class="flex flex-wrap w-1/2">
        <div class="md:p-2 p-1 w-1/2">
          <img alt="gallery" class="w-full object-cover h-full object-center block" src="https://gfgtower-9397.kxcdn.com/wp-content/uploads/2019/01/fronthome.jpeg">
        </div>
        <div class="md:p-2 p-1 w-1/2">
          <img alt="gallery" class="w-full object-cover h-full object-center block" src="https://spaceiq.com/app/default/assets/images/Web_150DPI-20190423_WeWork_Gangnam2_Common%20Area_5.jpg?v=1572382393">
        </div>
        <div class="md:p-2 p-1 w-full">
          <img alt="gallery" class="w-full h-full object-cover object-center block" src="https://images.adsttc.com/media/images/5b22/824c/f197/cc5c/d900/000e/slideshow/01_Coworking_Space_Building_inside_Building_Cover_Image.jpg?1528988192">
        </div>
      </div>
      <div class="flex flex-wrap w-1/2">
        <div class="md:p-2 p-1 w-full">
          <img alt="gallery" class="w-full h-full object-cover object-center block" src="https://colony.work/wp-content/uploads/2019/12/Colony-@-KLCC-event-lounge-2.jpeg">
        </div>
        <div class="md:p-2 p-1 w-1/2">
          <img alt="gallery" class="w-full object-cover h-full object-center block" src="https://i.pinimg.com/564x/db/06/46/db0646659f9f90845ba3f2ed18323f90.jpg">
        </div>
        <div class="md:p-2 p-1 w-1/2">
          <img alt="gallery" class="w-full object-cover h-full object-center block" src="https://www.kairos.com.my/wp-content/uploads/2019/05/best-coworking-spaces-in-KL-and-Selangor-26-1024x683.jpg">
        </div>
      </div>
    </div>

    <!-- Button -->
  <div class="w-full md:w-2/3 flex flex-col mb-16 items-center text-center">
      <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Want to visit our space?</h1>
      <div class="flex w-full justify-center items-end">
        <button class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg" wfd-id="450">Book a Tour!</button>
      </div>
      <p class="text-sm mt-2 text-gray-500 mb-8 w-full"></p>

    <!-- Apps Download -->
    <div class="flex">
        <button class="bg-gray-300 inline-flex py-3 px-5 rounded-lg items-center hover:bg-gray-400 focus:outline-none" wfd-id="449">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 512 512">
            <path d="M99.617 8.057a50.191 50.191 0 00-38.815-6.713l230.932 230.933 74.846-74.846L99.617 8.057zM32.139 20.116c-6.441 8.563-10.148 19.077-10.148 30.199v411.358c0 11.123 3.708 21.636 10.148 30.199l235.877-235.877L32.139 20.116zM464.261 212.087l-67.266-37.637-81.544 81.544 81.548 81.548 67.273-37.64c16.117-9.03 25.738-25.442 25.738-43.908s-9.621-34.877-25.749-43.907zM291.733 279.711L60.815 510.629c3.786.891 7.639 1.371 11.492 1.371a50.275 50.275 0 0027.31-8.07l266.965-149.372-74.849-74.847z"></path>
          </svg>
          <span class="ml-4 flex items-start flex-col leading-none">
            <span class="text-xs text-gray-600 mb-1">GET IT ON</span>
            <span class="title-font font-medium">Google Play</span>
          </span>
        </button>
        <button class="bg-gray-300 inline-flex py-3 px-5 rounded-lg items-center ml-4 hover:bg-gray-400 focus:outline-none" wfd-id="448">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 305 305">
            <path d="M40.74 112.12c-25.79 44.74-9.4 112.65 19.12 153.82C74.09 286.52 88.5 305 108.24 305c.37 0 .74 0 1.13-.02 9.27-.37 15.97-3.23 22.45-5.99 7.27-3.1 14.8-6.3 26.6-6.3 11.22 0 18.39 3.1 25.31 6.1 6.83 2.95 13.87 6 24.26 5.81 22.23-.41 35.88-20.35 47.92-37.94a168.18 168.18 0 0021-43l.09-.28a2.5 2.5 0 00-1.33-3.06l-.18-.08c-3.92-1.6-38.26-16.84-38.62-58.36-.34-33.74 25.76-51.6 31-54.84l.24-.15a2.5 2.5 0 00.7-3.51c-18-26.37-45.62-30.34-56.73-30.82a50.04 50.04 0 00-4.95-.24c-13.06 0-25.56 4.93-35.61 8.9-6.94 2.73-12.93 5.09-17.06 5.09-4.64 0-10.67-2.4-17.65-5.16-9.33-3.7-19.9-7.9-31.1-7.9l-.79.01c-26.03.38-50.62 15.27-64.18 38.86z"></path>
            <path d="M212.1 0c-15.76.64-34.67 10.35-45.97 23.58-9.6 11.13-19 29.68-16.52 48.38a2.5 2.5 0 002.29 2.17c1.06.08 2.15.12 3.23.12 15.41 0 32.04-8.52 43.4-22.25 11.94-14.5 17.99-33.1 16.16-49.77A2.52 2.52 0 00212.1 0z"></path>
          </svg>
          <span class="ml-4 flex items-start flex-col leading-none">
            <span class="text-xs text-gray-600 mb-1">Download on the</span>
            <span class="title-font font-medium">App Store</span>
          </span>
        </button>
      </div>
    </div>
  </div>
</section>
@endsection