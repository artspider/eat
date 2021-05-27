<x-layouts.master title="Welcome Page">
  <div x-data="{ open: true }" x-cloak class="flex ">
    <div class="w-1/5 bg-eat-white-50 shadow-lg h-screen sticky top-0 " x-show="open"
      x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
      x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
      x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90">
      <div class="h-20 bg-eat-fuccia-500 ">
        <img class="h-20 w-44 mx-auto" src="img/logo_fuccia.png " alt="">
      </div>
    </div>

    <div class="" x-bind:class="{ 'w-4/5 ml-auto ': open, 'w-full ml-0': !open }">
      <header class="w-full h-20 bg-eat-green-500 flex justify-between items-center">
        <div class="hamburger w-1/2 ml-8 cursor-pointer " @click="open = !open">
          <svg class="w-8 h-8 fill-current text-eat-fuccia-500 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M24 6h-24v-4h24v4zm0 4h-24v4h24v-4zm0 8h-24v4h24v-4z" /></svg>
        </div>
        <div class=" hidden md:w-2/5 xl:w-1/3 lg:flex justify-between items-center mr-8">
          <div class=" w-1/2 relative ">
            <input
              class="rounded-lg shadow-lg pl-10 border border-transparent focus:outline-none focus:ring-2 focus:ring-eat-fuccia-600 focus:border-transparent w-full bg-eat-white-500 "
              type="text">
            <svg class="absolute w-5 top-3 left-3 fill-current text-eat-olive-50" width="16" height="16"
              viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M15.8906 14.6531L12.0969 10.8594C12.025 10.7875 11.9313 10.75 11.8313 10.75H11.4187C12.4031 9.60938 13 8.125 13 6.5C13 2.90937 10.0906 0 6.5 0C2.90937 0 0 2.90937 0 6.5C0 10.0906 2.90937 13 6.5 13C8.125 13 9.60938 12.4031 10.75 11.4187V11.8313C10.75 11.9313 10.7906 12.025 10.8594 12.0969L14.6531 15.8906C14.8 16.0375 15.0375 16.0375 15.1844 15.8906L15.8906 15.1844C16.0375 15.0375 16.0375 14.8 15.8906 14.6531ZM6.5 11.5C3.7375 11.5 1.5 9.2625 1.5 6.5C1.5 3.7375 3.7375 1.5 6.5 1.5C9.2625 1.5 11.5 3.7375 11.5 6.5C11.5 9.2625 9.2625 11.5 6.5 11.5Z">
              </path>
            </svg>
          </div>
          <svg class="w-6 h-6 fill-current text-eat-olive-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path
              d="M0 3v18h24v-18h-24zm6.623 7.929l-4.623 5.712v-9.458l4.623 3.746zm-4.141-5.929h19.035l-9.517 7.713-9.518-7.713zm5.694 7.188l3.824 3.099 3.83-3.104 5.612 6.817h-18.779l5.513-6.812zm9.208-1.264l4.616-3.741v9.348l-4.616-5.607z" />
          </svg>
          <svg class="w-6 h-6 fill-current text-eat-olive-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path
              d="M15 21c0 1.598-1.392 3-2.971 3s-3.029-1.402-3.029-3h6zm.137-17.055c-.644-.374-1.042-1.07-1.041-1.82v-.003c.001-1.172-.938-2.122-2.096-2.122s-2.097.95-2.097 2.122v.003c.001.751-.396 1.446-1.041 1.82-4.668 2.709-1.985 11.715-6.862 13.306v1.749h20v-1.749c-4.877-1.591-2.193-10.598-6.863-13.306zm-3.137-2.945c.552 0 1 .449 1 1 0 .552-.448 1-1 1s-1-.448-1-1c0-.551.448-1 1-1zm-6.451 16c1.189-1.667 1.605-3.891 1.964-5.815.447-2.39.869-4.648 2.354-5.509 1.38-.801 2.956-.76 4.267 0 1.485.861 1.907 3.119 2.354 5.509.359 1.924.775 4.148 1.964 5.815h-12.903z" />
          </svg>
          <div class=" ">
            <img class=" rounded-full w-12 h-12 bg-cover " src="https://i.pravatar.cc/40" alt="">
          </div>
        </div>
      </header>

      <div class="container mx-auto p-10">
        <p class="text-5xl font-bold font-raleway text-eat-fuccia-700 ">Esta es Font RaleWay</p>
        <p class="text-5xl font-bold font-montserrat text-eat-fuccia-500 mb-10">Esta es Font Montserrat</p>

        <x-utils.title class="mb-5">
          Titulo
        </x-utils.title>
        <x-utils.subtitle>
          Subtitulo
        </x-utils.subtitle>
        <x-utils.text>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam alias asperiores ullam quas delectus hic
          dolorem minus unde veniam maiores facere odit ad reprehenderit reiciendis, iste porro rem autem magni ab
          perferendis quidem, eligendi tempore. Sed iusto voluptatum numquam ipsam animi praesentium aperiam officiis
          dolore. Quam, error! Dolorem eius itaque fuga odit, molestiae beatae atque assumenda iste accusamus
          laboriosam,
          reprehenderit aliquam consequuntur nihil! Id illum aliquam, tempore libero quaerat explicabo alias, cupiditate
          repudiandae iste labore commodi nobis minus illo iusto voluptas quo? Sapiente ipsam natus accusamus dolorem
          iste
          laboriosam dicta, neque debitis, repellat nam consequatur harum totam, asperiores similique dolorum.
        </x-utils.text>
        <x-utils.text-small>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam alias asperiores ullam quas delectus hic
          dolorem minus unde veniam maiores facere odit ad reprehenderit reiciendis, iste porro rem autem magni ab
          perferendis quidem, eligendi tempore. Sed iusto voluptatum numquam ipsam animi praesentium aperiam officiis
          dolore. Quam, error! Dolorem eius itaque fuga odit, molestiae beatae atque assumenda iste accusamus
          laboriosam,
          reprehenderit aliquam consequuntur nihil! Id illum aliquam, tempore libero quaerat explicabo alias, cupiditate
          repudiandae iste labore commodi nobis minus illo iusto voluptas quo? Sapiente ipsam natus accusamus dolorem
          iste
          laboriosam dicta, neque debitis, repellat nam consequatur harum totam, asperiores similique dolorum.
        </x-utils.text-small>


        <x-utils.button onclick="fireModal('Eat Modal','Mi mensaje', '{{url('/img/hamburger.jpg')}}')">
          Show Success
        </x-utils.button>

        <x-utils.button color=eat-fuccia>
          Show Alert
        </x-utils.button>

      </div>
    </div>
  </div>
</x-layouts.master>