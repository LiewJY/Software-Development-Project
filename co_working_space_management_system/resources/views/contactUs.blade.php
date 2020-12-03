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
        <table class="table-fixed border-collapse border border-gray-800 border-t-8 border-b-8 border-double">
          <tr>
            <th class="w-1/4 border border-gray-600 border-b-8 border-double border-l-4 border-r-4">Day</th>
            <th class="w-1/2 border border-gray-600 border-b-8 border-double border-r-4 border-r-4">Time</th>
          </tr>
          <tr>
            <td class="border border-gray-600 border-b-8 border-double border-l-4 border-r-4">Monday</td>
            <td class="border border-gray-600 border-b-8 border-double border-l-4 border-r-4">9am - 9pm</td>
          </tr>
          <tr>
            <td class="border border-gray-600 border-b-8 border-double border-l-4 border-r-4">Tuesday</td>
            <td class="border border-gray-600 border-b-8 border-double border-l-4 border-r-4">9am - 9pm</td>
          </tr>
          <tr>
            <td class="border border-gray-600 border-b-8 border-double border-l-4 border-r-4">Wednesday</td>
            <td class="border border-gray-600 border-b-8 border-double border-l-4 border-r-4">9am - 9pm</td>
            </tr>
          <tr>
            <td class="border border-gray-600 border-b-8 border-double border-l-4 border-r-4">Thursday</td>
            <td class="border border-gray-600 border-b-8 border-double border-l-4 border-r-4">9am - 9pm</td>
          </tr>
          <tr>
            <td class="border border-gray-600 border-b-8 border-double border-l-4 border-r-4">Friday</td>
            <td class="border border-gray-600 border-b-8 border-double border-l-4 border-r-4">9am - 9pm</td>
          </tr>
          <tr>
            <td class="border border-gray-600 border-b-8 border-double border-l-4 border-r-4">Saturday</td>
            <td class="border border-gray-600 border-b-8 border-double border-l-4 border-r-4">9am - 9pm</td>
          </tr>
          <tr>
            <td class="border border-gray-600 border-b-8 border-double border-l-4 border-r-4">Sunday</td>
            <td class="border border-gray-600 border-b-8 border-double border-l-4 border-r-4">Closed</td>
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
    </div>
  </div>
</section>
@endsection