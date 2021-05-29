<x-layouts.master title="Welcome Page">


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

</x-layouts.master>