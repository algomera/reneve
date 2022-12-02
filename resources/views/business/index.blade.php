<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    List of Business
                </div>
            </div>
            <div class="flex gap-4 mt-5">
                @foreach ($businesses as $business)
                    <a href="{{route('business.home', ['subdomain' => $business->subdomain])}}" class="w-[200px] h-[300px] border border-gray-400 rounded-lg shadow-md hover:brightness-110">
                        <div class="w-full h-2/3 bg-slate-400 rounded-t-lg">
                            <img class="w-full h-full rounded-t-lg" src="{{$business->company_logo}}" alt="">
                        </div>
                        <div class="w-full h-1/3 flex justify-center items-center">
                            <span class="uppercase font-semibold">{{$business->name}}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
