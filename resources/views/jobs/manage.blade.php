<x-layout>
     <div class="mx-4">
          <div class="bg-gray-50 border border-gray-200 p-10 rounded">
               <header>
                    <h1 class="text-3xl text-center font-bold my-6 uppercase">
                         Manage Jobs
                    </h1>
               </header>

               <table class="w-full table-auto rounded-sm">
                    <tbody>
                         @unless($jobs->isEmpty())
                         @foreach($jobs as $job)
                         <tr class="border-gray-300">
                              <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                   <a href="/jobs/{{$job->id}}">
                                        {{$job->title}}
                                   </a>
                              </td>
                              <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                   <a href="/jobs/{{$job->id}}/edit" class="text-blue-400 px-6 py-2 rounded-xl"><i
                                             class="fa-solid fa-pen-to-square"></i>
                                        Edit</a>
                              </td>
                              <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                   <form method="POST" action="/jobs/{{$job->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 text-white rounded py-2 px-4 hover:bg-red-600">
                                             <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                   </form>
                              </td>
                         </tr>
                         @endforeach
                         @else
                         <tr>
                              <td colspan="3" class="text-center py-8">
                                   <p class="text-lg">You have not posted any jobs yet.</p>
                                   <a href="/jobs/create" class="text-blue-400 px-6 py-2 rounded-xl"><i
                                             class="fa-solid fa-plus"></i>
                                        Post a Job</a>
                              </td>
                         </tr>
                         @endunless
                    </tbody>
               </table>
          </div>
     </div>
</x-layout>