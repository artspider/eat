<x-layouts.master title="Welcome Page">


  <x-utils.container>
  
  <!-- Con flexbox -->
    {{--<div class="w-full h-auto xl:flex lg:justify-between lg:flex-wrap">
      <div class="flex flex-col md:flex-row md:justify-between lg:w-1/2">
        <div class="md:w-1/2">
          <div class="shadow-md pr-2 mr-2">
            <x-utils.subtitle class="text-center my-2 lg:h-24">
              Ingresos
            </x-utils.subtitle>
            <canvas id="chartEarnings" class="w-48 h-auto">
            </canvas>
          </div>
        </div>
        
        <div class="md:w-1/2">
          <div class="shadow-lg pr-2 mr-2">
            <x-utils.subtitle class="text-center my-2 lg:h-24">
              Egresos
            </x-utils.subtitle>
            <canvas id="chartExpense" class="w-48 h-auto"></canvas>
          </div>
        </div>
      </div><!-- 1 -->


      <div class="flex flex-col md:flex-row md:justify-between lg:w-1/2">
        <div class="md:w-1/2">
          <div class="shadow-xl pr-2 mr-2">
            <x-utils.subtitle class="text-center my-2 lg:h-24">
              Total visitantes
            </x-utils.subtitle>
            <canvas id="chartOrders" class="w-48 h-auto relative">
            </canvas>
          </div>
        </div>
        
        <div class="md:w-1/2">
          <div class="shadow-2xl pr-2 mr-2">
            <x-utils.subtitle class="text-center my-2 lg:h-24">
              Visitantes
            </x-utils.subtitle>
            <canvas id="chartVisitors" class="w-48 h-auto "></canvas>
          </div>
        </div>
      </div><!-- 2 -->
    </div>--}}


  <!-- Con grid -->
    <div class="grid grid-rows-1 md:grid-cols-2 md:gap-4 xl:grid-cols-4">
      <div class="mb-8">
          <div class="shadow-md p-2 ">
            <x-utils.subtitle class="text-center my-2 lg:h-24">
              Ingresos
            </x-utils.subtitle>
            <canvas id="chartEarnings" class="w-48 h-auto">
            </canvas>
          </div>
      </div>
      <div class="mb-8">
          <div class="shadow-md p-2 ">
            <x-utils.subtitle class="text-center my-2 lg:h-24">
              Egresos
            </x-utils.subtitle>
            <canvas id="chartExpense" class="w-48 h-auto"></canvas>
          </div>
      </div>
      <div class="mb-8">
          <div class="shadow-md p-2 ">
            <x-utils.subtitle class="text-center my-2 lg:h-24">
              Total visitantes
            </x-utils.subtitle>
            <canvas id="chartOrders" class="w-48 h-auto relative">
            </canvas>
          </div>
      </div>
      <div class="mb-8">
          <div class="shadow-md p-2 ">
            <x-utils.subtitle class="text-center my-2 lg:h-24">
              Visitantes
            </x-utils.subtitle>
            <canvas id="chartVisitors" class="w-48 h-auto "></canvas>
          </div>
      </div>
    </div>

<!-- Daily trending menu -->
    <div class="2xl:flex 2xl:justify-between mb-10">
      <!-- 1 -->
        <div class="2xl:flex-1 order-2 2xl:ml-4 rounded-md shadow-md">
          <x-utils.subsubtitle class="p-5 text-center">Contador de billetes</x-utils.subsubtitle>

          
          <div>
            <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
              <div class="px-3 py-7 md:p-7">
                <div class="flex justify-between items-center">
                  <div class="w-24 h-auto flex-shrink-1 rounded-lg ">
                    <img class="rounded-lg " src="https://pbs.twimg.com/media/EnO0g4ZXYAU4cXy.jpg" alt="">
                  </div>
                  <div class="flex flex-col flex-1 mx-5">
                    <p class="lg:text-xl self-end">Total</p>
                    <div class="flex justify-between">
                      <p class="font-bold lg:text-xl"><span class="text-gray-400">Unidades </span>15<b>x</b></p>
                      <x-utils.text class="lg:text-lg"><span>$</span>7.50</x-utils.text>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!--.5c -->

          <div>
            <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
              <div class="px-3 py-7 md:p-7">
                <div class="flex justify-between items-center">
                  <div class="w-24 h-auto flex-shrink-1 rounded-lg">
                    <img src="https://1.bp.blogspot.com/-VWRAlCt1ork/WEwjsyf5zgI/AAAAAAAAAx4/WvGWPmQerTcZn_AwyfPTNG_HlkCkruyDACEw/s1600/Moneda-nuevos-pesos-1-peso-reverso.png" alt="">
                  </div>
                  <div class="flex flex-col flex-1 mx-5">
                    <p class="lg:text-xl self-end">Total</p>
                    <div class="flex justify-between">
                      <p class="font-bold lg:text-xl"><span class="text-gray-400">Unidades </span>30<b>x</b></p>
                      <x-utils.text class="lg:text-lg"><span>$</span>30.00</x-utils.text>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- 1p -->

          <div>
            <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
              <div class="px-3 py-7 md:p-7">
                <div class="flex justify-between items-center">
                  <div class="w-24 h-auto flex-shrink-1 ">
                    <img  src="https://i.colnect.net/f/3782/629/2-Pesos.jpg" alt="">
                  </div>
                  <div class="flex flex-col flex-1 mx-5">
                    <p class="lg:text-xl self-end">Total</p>
                    <div class="flex justify-between">
                      <p class="font-bold lg:text-xl"><span class="text-gray-400">Unidades </span>20<b>x</b></p>
                      <x-utils.text class="lg:text-lg"><span>$</span>40.00</x-utils.text>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- 2p -->

          <div>
            <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
              <div class="px-3 py-7 md:p-7">
                <div class="flex justify-between items-center">
                  <div class="w-24 h-auto flex-shrink-1">
                    <img  src="https://i.colnect.net/f/2921/784/5-Pesos.jpg" alt="">
                  </div>
                  <div class="flex flex-col flex-1 mx-5">
                    <p class="lg:text-xl self-end">Total</p>
                    <div class="flex justify-between">
                      <p class="font-bold lg:text-xl"><span class="text-gray-400">Unidades </span>10<b>x</b></p>
                      <x-utils.text class="lg:text-lg"><span>$</span>50.00</x-utils.text>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- 5p -->

          <div>
            <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
              <div class="px-3 py-7 md:p-7">
                <div class="flex justify-between items-center">
                  <div class="w-24 h-auto flex-shrink-1">
                    <img src="https://i.colnect.net/f/3336/608/10-Pesos.jpg" alt="">
                  </div>
                  <div class="flex flex-col flex-1 mx-5">
                    <p class="lg:text-xl self-end">Total</p>
                    <div class="flex justify-between">
                      <p class="font-bold lg:text-xl"><span class="text-gray-400">Unidades </span>27<b>x</b></p>
                      <x-utils.text class="lg:text-lg"><span>$</span>270.00</x-utils.text>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- 10p -->

          <div>
            <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
              <div class="px-3 py-7 md:p-7">
                <div class="flex justify-between items-center">
                  <div class="w-24 h-auto flex-shrink-1 ">
                    <img src="https://www.asfiscal.com/wp-content/uploads/2018/09/mexico-20-pesos-benito-juarez-aztec-city-2012-p-image-88084-grande.jpg" alt="">
                  </div>
                  <div class="flex flex-col flex-1 mx-5">
                    <p class="lg:text-xl self-end">Total</p>
                    <div class="flex justify-between">
                      <p class="font-bold lg:text-xl"><span class="text-gray-400">Unidades </span>20<b>x</b></p>
                      <x-utils.text class="lg:text-lg"><span>$</span>400.00</x-utils.text>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- 20pB -->

          <div>
            <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
              <div class="px-3 py-7 md:p-7">
                <div class="flex justify-between items-center">
                  <div class="w-24 h-auto flex-shrink-1 ">
                    <img src="https://2.bp.blogspot.com/-80Ido9afxyQ/V0Jcq3ZtlpI/AAAAAAAAdyQ/zeX0r-5JAOUWzX7eqfC0twbuvGmb0zs8gCLcB/w1200-h630-p-k-no-nu/P-123g.2-1.jpg" alt="">
                  </div>
                  <div class="flex flex-col flex-1 mx-5">
                    <p class="lg:text-xl self-end">Total</p>
                    <div class="flex justify-between">
                      <p class="font-bold lg:text-xl"><span class="text-gray-400">Unidades </span>10<b>x</b></p>
                      <x-utils.text class="lg:text-lg"><span>$</span>500.00</x-utils.text>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- 50pB -->

          <div>
            <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
              <div class="px-3 py-7 md:p-7">
                <div class="flex justify-between items-center">
                  <div class="w-24 h-auto flex-shrink-1">
                    <img src="https://cloud10.todocoleccion.online/billetes-extranjeros/tc/2019/02/20/23/152228126_125581694.jpg" alt="">
                  </div>
                  <div class="flex flex-col flex-1 mx-5">
                    <p class="lg:text-xl self-end">Total</p>
                    <div class="flex justify-between">
                      <p class="font-bold lg:text-xl"><span class="text-gray-400">Unidades </span>5<b>x</b></p>
                      <x-utils.text class="lg:text-lg"><span>$</span>500.00</x-utils.text>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- 100pB -->

          <div>
            <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
              <div class="px-3 py-7 md:p-7">
                <div class="flex justify-between items-center">
                  <div class="w-24 h-auto flex-shrink-1 ">
                    <img src="https://http2.mlstatic.com/D_NQ_NP_752123-MCO31081094878_062019-O.jpg" alt="">
                  </div>
                  <div class="flex flex-col flex-1 mx-5">
                    <p class="lg:text-xl self-end">Total</p>
                    <div class="flex justify-between">
                      <p class="font-bold lg:text-xl"><span class="text-gray-400">Unidades </span>2<b>x</b></p>
                      <x-utils.text class="lg:text-lg"><span>$</span>400.00</x-utils.text>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- 200pB -->

          <div>
            <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
              <div class="px-3 py-7 md:p-7">
                <div class="flex justify-between items-center">
                  <div class="w-24 h-auto flex-shrink-1 rounded-lg relative">
                    <img src="https://s03.s3c.es/imag/_v0/772x420/5/e/2/billete500.jpg" alt="">
                  </div>
                  <div class="flex flex-col flex-1 mx-5">
                    <p class="lg:text-xl self-end">Total</p>
                    <div class="flex justify-between">
                      <p class="font-bold lg:text-xl"><span class="text-gray-400">Unidades </span>2<b>x</b></p>
                      <x-utils.text class="lg:text-lg"><span>$</span>1000.00</x-utils.text>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- 500pB -->

          <div>
            <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
              <div class="px-3 py-7 md:p-7">
                <div class="flex justify-between items-center">
                  <div class="w-24 h-auto flex-shrink-1 rounded-lg relative">
                    <img src="http://cdn2.dineroenimagen.com/media/dinero/billete-1000-hermila-galindo.jpg" alt="">
                  </div>
                  <div class="flex flex-col flex-1 mx-5">
                    <p class="lg:text-xl self-end">Total</p>
                    <div class="flex justify-between">
                      <p class="font-bold lg:text-xl"><span class="text-gray-400">Unidades </span>1<b>x</b></p>
                      <x-utils.text class="lg:text-lg"><span>$</span>1000.00</x-utils.text>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- 1000pB -->
        </div>


      <!-- 2 -->
      <div class="shadow-lg 2xl:w-1/3 order-1">
        <x-utils.subsubtitle class="p-5 text-center">Comidas diarias mas vendidas</x-utils.subsubtitle>

        <div>
          <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
            <div class="px-3 py-7 md:p-7">
              <div class="flex justify-between items-center">
                <div class="w-24 h-24 flex-shrink-1 rounded-lg relative">
                  <img class="rounded-lg absolute" src="https://scontent.fcvj2-1.fna.fbcdn.net/v/t1.6435-9/205080132_225380556095059_7208562613423064108_n.jpg?_nc_cat=108&ccb=1-3&_nc_sid=730e14&_nc_eui2=AeGBuln_N2i5TLPws4tOEtbSslgIfhEibY2yWAh-ESJtjcYuU3C0Vq3IHoG8vMHmRsLft8PjzyW6GcB193tUm6O9&_nc_ohc=j-gjNRhtzgsAX8GVAKc&_nc_ht=scontent.fcvj2-1.fna&oh=e5501b1acc279fad6d0dd08225070c4b&oe=60E96FFE" alt="">
                  <div class="bg-eat-olive-500 top-16 right-4 rounded-full border-4 w-16 h-16 absolute">
                      <p class="text-center absolute top-3 left-3 font-bold text-2xl text-white">#<span>1</span> </p>
                  </div>
                </div>
                <div class="flex flex-col flex-1 mx-5">
                <p class="lg:text-xl">Calabazitas rellenas</p>
                  <div class="flex justify-between">
                    <x-utils.text class="lg:text-lg"><span>$</span>84.00</x-utils.text>
                    <p class="font-bold lg:text-xl"><span class="text-gray-400">Ordenado </span>89<b>x</b></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
            <div class="px-3 py-7 md:p-7">
              <div class="flex justify-between items-center">
                <div class="w-24 h-24 flex-shrink-1 rounded-lg relative">
                  <img class="rounded-lg absolute" src="https://scontent.fcvj2-1.fna.fbcdn.net/v/t1.6435-9/205080132_225380556095059_7208562613423064108_n.jpg?_nc_cat=108&ccb=1-3&_nc_sid=730e14&_nc_eui2=AeGBuln_N2i5TLPws4tOEtbSslgIfhEibY2yWAh-ESJtjcYuU3C0Vq3IHoG8vMHmRsLft8PjzyW6GcB193tUm6O9&_nc_ohc=j-gjNRhtzgsAX8GVAKc&_nc_ht=scontent.fcvj2-1.fna&oh=e5501b1acc279fad6d0dd08225070c4b&oe=60E96FFE" alt="">
                  <div class="bg-eat-olive-500 top-16 right-4 rounded-full border-4 w-16 h-16 absolute">
                      <p class="text-center absolute top-3 left-3 font-bold text-2xl text-white">#<span>2</span> </p>
                  </div>
                </div>
                <div class="flex flex-col flex-1 mx-5">
                <p class="lg:text-xl">Calabazitas rellenas</p>
                  <div class="flex justify-between">
                    <x-utils.text class="lg:text-lg"><span>$</span>84.00</x-utils.text>
                    <p class="font-bold lg:text-xl"><span class="text-gray-400">Ordenado </span>89<b>x</b></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
            <div class="px-3 py-7 md:p-7">
              <div class="flex justify-between items-center">
                <div class="w-24 h-24 flex-shrink-1 rounded-lg relative">
                  <img class="rounded-lg absolute" src="https://scontent.fcvj2-1.fna.fbcdn.net/v/t1.6435-9/205080132_225380556095059_7208562613423064108_n.jpg?_nc_cat=108&ccb=1-3&_nc_sid=730e14&_nc_eui2=AeGBuln_N2i5TLPws4tOEtbSslgIfhEibY2yWAh-ESJtjcYuU3C0Vq3IHoG8vMHmRsLft8PjzyW6GcB193tUm6O9&_nc_ohc=j-gjNRhtzgsAX8GVAKc&_nc_ht=scontent.fcvj2-1.fna&oh=e5501b1acc279fad6d0dd08225070c4b&oe=60E96FFE" alt="">
                  <div class="bg-eat-olive-500 top-16 right-4 rounded-full border-4 w-16 h-16 absolute">
                      <p class="text-center absolute top-3 left-3 font-bold text-2xl text-white">#<span>3</span> </p>
                  </div>
                </div>
                <div class="flex flex-col flex-1 mx-5">
                <p class="lg:text-xl">Calabazitas rellenas</p>
                  <div class="flex justify-between">
                    <x-utils.text class="lg:text-lg"><span>$</span>84.00</x-utils.text>
                    <p class="font-bold lg:text-xl"><span class="text-gray-400">Ordenado </span>89<b>x</b></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
            <div class="px-3 py-7 md:p-7">
              <div class="flex justify-between items-center">
                <div class="w-24 h-24 flex-shrink-1 rounded-lg relative">
                  <img class="rounded-lg absolute" src="https://scontent.fcvj2-1.fna.fbcdn.net/v/t1.6435-9/205080132_225380556095059_7208562613423064108_n.jpg?_nc_cat=108&ccb=1-3&_nc_sid=730e14&_nc_eui2=AeGBuln_N2i5TLPws4tOEtbSslgIfhEibY2yWAh-ESJtjcYuU3C0Vq3IHoG8vMHmRsLft8PjzyW6GcB193tUm6O9&_nc_ohc=j-gjNRhtzgsAX8GVAKc&_nc_ht=scontent.fcvj2-1.fna&oh=e5501b1acc279fad6d0dd08225070c4b&oe=60E96FFE" alt="">
                  <div class="bg-eat-olive-500 top-16 right-4 rounded-full border-4 w-16 h-16 absolute">
                      <p class="text-center absolute top-3 left-3 font-bold text-2xl text-white">#<span>4</span> </p>
                  </div>
                </div>
                <div class="flex flex-col flex-1 mx-5">
                <p class="lg:text-xl">Calabazitas rellenas</p>
                  <div class="flex justify-between">
                    <x-utils.text class="lg:text-lg"><span>$</span>84.00</x-utils.text>
                    <p class="font-bold lg:text-xl"><span class="text-gray-400">Ordenado </span>89<b>x</b></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
            <div class="px-3 py-7 md:p-7">
              <div class="flex justify-between items-center">
                <div class="w-24 h-24 flex-shrink-1 rounded-lg relative">
                  <img class="rounded-lg absolute" src="https://scontent.fcvj2-1.fna.fbcdn.net/v/t1.6435-9/205080132_225380556095059_7208562613423064108_n.jpg?_nc_cat=108&ccb=1-3&_nc_sid=730e14&_nc_eui2=AeGBuln_N2i5TLPws4tOEtbSslgIfhEibY2yWAh-ESJtjcYuU3C0Vq3IHoG8vMHmRsLft8PjzyW6GcB193tUm6O9&_nc_ohc=j-gjNRhtzgsAX8GVAKc&_nc_ht=scontent.fcvj2-1.fna&oh=e5501b1acc279fad6d0dd08225070c4b&oe=60E96FFE" alt="">
                  <div class="bg-eat-olive-500 top-16 right-4 rounded-full border-4 w-16 h-16 absolute">
                      <p class="text-center absolute top-3 left-3 font-bold text-2xl text-white">#<span>5</span> </p>
                  </div>
                </div>
                <div class="flex flex-col flex-1 mx-5">
                <p class="lg:text-xl">Calabazitas rellenas</p>
                  <div class="flex justify-between">
                    <x-utils.text class="lg:text-lg"><span>$</span>84.00</x-utils.text>
                    <p class="font-bold lg:text-xl"><span class="text-gray-400">Ordenado </span>89<b>x</b></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
            <div class="px-3 py-7 md:p-7">
              <div class="flex justify-between items-center">
                <div class="w-24 h-24 flex-shrink-1 rounded-lg relative">
                  <img class="rounded-lg absolute" src="https://scontent.fcvj2-1.fna.fbcdn.net/v/t1.6435-9/205080132_225380556095059_7208562613423064108_n.jpg?_nc_cat=108&ccb=1-3&_nc_sid=730e14&_nc_eui2=AeGBuln_N2i5TLPws4tOEtbSslgIfhEibY2yWAh-ESJtjcYuU3C0Vq3IHoG8vMHmRsLft8PjzyW6GcB193tUm6O9&_nc_ohc=j-gjNRhtzgsAX8GVAKc&_nc_ht=scontent.fcvj2-1.fna&oh=e5501b1acc279fad6d0dd08225070c4b&oe=60E96FFE" alt="">
                  <div class="bg-eat-olive-500 top-16 right-4 rounded-full border-4 w-16 h-16 absolute">
                      <p class="text-center absolute top-3 left-3 font-bold text-2xl text-white">#<span>6</span> </p>
                  </div>
                </div>
                <div class="flex flex-col flex-1 mx-5">
                <p class="lg:text-xl">Calabazitas rellenas</p>
                  <div class="flex justify-between">
                    <x-utils.text class="lg:text-lg"><span>$</span>84.00</x-utils.text>
                    <p class="font-bold lg:text-xl"><span class="text-gray-400">Ordenado </span>89<b>x</b></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
            <div class="px-3 py-7 md:p-7">
              <div class="flex justify-between items-center">
                <div class="w-24 h-24 flex-shrink-1 rounded-lg relative">
                  <img class="rounded-lg absolute" src="https://scontent.fcvj2-1.fna.fbcdn.net/v/t1.6435-9/205080132_225380556095059_7208562613423064108_n.jpg?_nc_cat=108&ccb=1-3&_nc_sid=730e14&_nc_eui2=AeGBuln_N2i5TLPws4tOEtbSslgIfhEibY2yWAh-ESJtjcYuU3C0Vq3IHoG8vMHmRsLft8PjzyW6GcB193tUm6O9&_nc_ohc=j-gjNRhtzgsAX8GVAKc&_nc_ht=scontent.fcvj2-1.fna&oh=e5501b1acc279fad6d0dd08225070c4b&oe=60E96FFE" alt="">
                  <div class="bg-eat-olive-500 top-16 right-4 rounded-full border-4 w-16 h-16 absolute">
                      <p class="text-center absolute top-3 left-3 font-bold text-2xl text-white">#<span>7</span> </p>
                  </div>
                </div>
                <div class="flex flex-col flex-1 mx-5">
                <p class="lg:text-xl">Calabazitas rellenas</p>
                  <div class="flex justify-between">
                    <x-utils.text class="lg:text-lg"><span>$</span>84.00</x-utils.text>
                    <p class="font-bold lg:text-xl"><span class="text-gray-400">Ordenado </span>89<b>x</b></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
            <div class="px-3 py-7 md:p-7">
              <div class="flex justify-between items-center">
                <div class="w-24 h-24 flex-shrink-1 rounded-lg relative">
                  <img class="rounded-lg absolute" src="https://scontent.fcvj2-1.fna.fbcdn.net/v/t1.6435-9/205080132_225380556095059_7208562613423064108_n.jpg?_nc_cat=108&ccb=1-3&_nc_sid=730e14&_nc_eui2=AeGBuln_N2i5TLPws4tOEtbSslgIfhEibY2yWAh-ESJtjcYuU3C0Vq3IHoG8vMHmRsLft8PjzyW6GcB193tUm6O9&_nc_ohc=j-gjNRhtzgsAX8GVAKc&_nc_ht=scontent.fcvj2-1.fna&oh=e5501b1acc279fad6d0dd08225070c4b&oe=60E96FFE" alt="">
                  <div class="bg-eat-olive-500 top-16 right-4 rounded-full border-4 w-16 h-16 absolute">
                      <p class="text-center absolute top-3 left-3 font-bold text-2xl text-white">#<span>8</span> </p>
                  </div>
                </div>
                <div class="flex flex-col flex-1 mx-5">
                <p class="lg:text-xl">Calabazitas rellenas</p>
                  <div class="flex justify-between">
                    <x-utils.text class="lg:text-lg"><span>$</span>84.00</x-utils.text>
                    <p class="font-bold lg:text-xl"><span class="text-gray-400">Ordenado </span>89<b>x</b></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
            <div class="px-3 py-7 md:p-7">
              <div class="flex justify-between items-center">
                <div class="w-24 h-24 flex-shrink-1 rounded-lg relative">
                  <img class="rounded-lg absolute" src="https://scontent.fcvj2-1.fna.fbcdn.net/v/t1.6435-9/205080132_225380556095059_7208562613423064108_n.jpg?_nc_cat=108&ccb=1-3&_nc_sid=730e14&_nc_eui2=AeGBuln_N2i5TLPws4tOEtbSslgIfhEibY2yWAh-ESJtjcYuU3C0Vq3IHoG8vMHmRsLft8PjzyW6GcB193tUm6O9&_nc_ohc=j-gjNRhtzgsAX8GVAKc&_nc_ht=scontent.fcvj2-1.fna&oh=e5501b1acc279fad6d0dd08225070c4b&oe=60E96FFE" alt="">
                  <div class="bg-eat-olive-500 top-16 right-4 rounded-full border-4 w-16 h-16 absolute">
                      <p class="text-center absolute top-3 left-3 font-bold text-2xl text-white">#<span>9</span> </p>
                  </div>
                </div>
                <div class="flex flex-col flex-1 mx-5">
                <p class="lg:text-xl">Calabazitas rellenas</p>
                  <div class="flex justify-between">
                    <x-utils.text class="lg:text-lg"><span>$</span>84.00</x-utils.text>
                    <p class="font-bold lg:text-xl"><span class="text-gray-400">Ordenado </span>89<b>x</b></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div>
          <div class="transition-all hover:bg-eat-green-500 pb-4 rounded-lg mx-2 ">
            <div class="px-3 py-7 md:p-7">
              <div class="flex justify-between items-center">
                <div class="w-24 h-24 flex-shrink-1 rounded-lg relative">
                  <img class="rounded-lg absolute" src="https://scontent.fcvj2-1.fna.fbcdn.net/v/t1.6435-9/205080132_225380556095059_7208562613423064108_n.jpg?_nc_cat=108&ccb=1-3&_nc_sid=730e14&_nc_eui2=AeGBuln_N2i5TLPws4tOEtbSslgIfhEibY2yWAh-ESJtjcYuU3C0Vq3IHoG8vMHmRsLft8PjzyW6GcB193tUm6O9&_nc_ohc=j-gjNRhtzgsAX8GVAKc&_nc_ht=scontent.fcvj2-1.fna&oh=e5501b1acc279fad6d0dd08225070c4b&oe=60E96FFE" alt="">
                  <div class="bg-eat-olive-500 top-16 right-4 rounded-full border-4 w-16 h-16 absolute">
                      <p class="text-center absolute top-3 left-3 font-bold text-2xl text-white">#<span>10</span> </p>
                  </div>
                </div>
                <div class="flex flex-col flex-1 mx-5">
                <p class="lg:text-xl">Calabazitas rellenas</p>
                  <div class="flex justify-between">
                    <x-utils.text class="lg:text-lg"><span>$</span>84.00</x-utils.text>
                    <p class="font-bold lg:text-xl"><span class="text-gray-400">Ordenado </span>89<b>x</b></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      
      </div>
    </div>

  <!-- Promocion semanal -->
    <div class="h-screen w-full flex 2xl:flex 2xl:justify-between mb-10">
      
      <div class="2xl:flex-1 rounded-md shadow-md mr-4">
        <x-utils.subsubtitle class="p-5 text-center">Promocion semanal</x-utils.subsubtitle>
      </div>

      <div class="shadow-lg 2xl:w-1/3">
      </div>
      
    </div>


    {{--Abajo esta como utilizar las utilidades--}}
    {{--<div>
        <p>hola testtt</p>
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
        </x-utils.text>
        <x-utils.text-small>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laboriosam alias asperiores ullam quas delectus hic
          dolorem minus unde veniam maiores facere odit ad reprehenderit reiciendis, iste porro rem autem magni ab
          perferendis quidem, eligendi tempore. Sed iusto voluptatum numquam ipsam animi praesentium aperiam officiis
          dolore. Quam, error! Dolorem eius itaque fuga odit, molestiae beatae atque assumenda iste accusamus
          laboriosam,
          reprehenderit aliquam consequun
          tur nihil! Id illum aliquam, tempore libero quaerat explicabo alias, cupiditate
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
    </div>--}}
  </x-utils.container>

  <script>
            var ctx = document.getElementById('chartEarnings').getContext('2d');
            console.log(ctx)
            var myChart = new Chart(ctx, {
              draw: function() {
                myLineExtend.apply(this, arguments);
                // text styles below
                this.chart.chart.ctx.textAlign = "center"
                this.chart.chart.ctx.font = "20px Arial black";
                this.chart.chart.ctx.fillText("Lorem Ipsum Blah Blah", 300, 150)  // text, x-pos, y-pos
              },
                type: 'line',
                data: {
                    labels: ['Lun', 'Mar', 'Mier', 'Juev', 'Vier',],
                    datasets: [{
                        label: 'Días',
                        data: [12, 19, 3, 5, 2],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',

                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                  animations: {
                    tension: {
                      duration: 1000,
                      easing: 'linear',
                      from: 1,
                      to: 0,
                      loop: true
                    }
                  },
                  scales: {
                    y: {
                      min: 0,
                      max: 100
                    }
                  },
                  responsive: true,
                }
            });

            var ctx = document.getElementById('chartExpense').getContext('2d');
            console.log(ctx)
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Lun', 'Mar', 'Mier', 'Juev', 'Vier',],
                    datasets: [{
                        label: 'Días',
                        data: [12, 19, 3, 5, 2],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',

                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                  animations: {
                    tension: {
                      duration: 1000,
                      easing: 'linear',
                      from: 1,
                      to: 0,
                      loop: true
                    }
                  },
                  scales: {
                    y: {
                      min: 0,
                      max: 100
                    }
                  },
                  responsive: true,
                }
            });/* chart2 */

            var ctx = document.getElementById('chartOrders').getContext('2d');
            console.log(ctx)
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Lun', 'Mar', 'Mier', 'Juev', 'Vier',],
                    datasets: [{
                        label: 'Días',
                        data: [12, 19, 3, 5, 2],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',

                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                  animations: {
                    tension: {
                      duration: 1000,
                      easing: 'linear',
                      from: 1,
                      to: 0,
                      loop: true
                    }
                  },
                  scales: {
                    y: {
                      min: 0,
                      max: 100
                    }
                  },
                  responsive: true,
                }
            });/* chart3 */

            var ctx = document.getElementById('chartVisitors').getContext('2d');
            console.log(ctx)
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Lun', 'Mar', 'Mier', 'Juev', 'Vier',],
                    datasets: [{
                        label: 'Días',
                        data: [12, 19, 3, 5, 2],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',

                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                  animations: {
                    tension: {
                      duration: 1000,
                      easing: 'linear',
                      from: 1,
                      to: 0,
                      loop: true
                    }
                  },
                  scales: {
                    y: {
                      min: 0,
                      max: 100
                    }
                  },
                  responsive: true,
                }
            });/* chart3 */


        </script>
</x-layouts.master>