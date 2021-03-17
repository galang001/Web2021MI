<x-awetemplate-layout>     
<h1 class="text-3xl text-black pb-6">Biodata</h1> 
<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-8 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                No
              </th>
              <th scope="col" class="px-8 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                Nama
              </th>
              <th scope="col" class="px-8 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                Jenis Kelamin
              </th>
              <th scope="col" class="px-8 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                Alamat
              </th>
              <th scope="col" class="px-8 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                Tanggal Lahir
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200 text-left">
          <div class=" items-center justify-end ">
        <a href="{{route('biodata.create')}}" class="ml-2 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-small text-white bg-indigo-600 hover:bg-indigo-700">
          Tambah
        </a>
      </div>
            <tr>
            <div class="flex items-center">
            <?php $no=1;?>
              @foreach ($bio as $item)
                  <td class="px-8 py-3 text-left font-medium">{{$no}}</td>
                  <td class="px-8 py-3 text-left font-medium">{{$item->nama}}</td>
                  <td class="px-8 py-3 text-left font-medium">{{$item->j_kelamin}}</td>
                  <td class="px-8 py-3 text-left font-medium">{{$item->alamat}}</td>
                  <td class="px-8 py-3 text-left font-medium">{{$item->tanggal_lahir}}</td>
                  <td>
                  <form action="{{route('biodata.destroy',$item->id)}}"  method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="{{route('biodata.edit',$item->id)}}" class="btn btn-xs p-2 rounded bg-blue-400 m-3 hover:bg-blue-600 hover:text-white">Edit</a><button class="btn btn-xs p-2 rounded bg-red-500 m-3 hover:bg-red-800 hover:text-white">Delete</button>
                    </form>
                    </td>
            </div>
            </tr>
              <?php $no++; ?>
              @endforeach
            </tr>

            <!-- More items... -->
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


 
</x-awetemplate-layout>