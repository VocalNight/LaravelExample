<x-layout>
    <x-slot:heading>
        Job Page
    </x-slot:heading>

    <ul>
        @foreach($jobs as $job)
            <a href="/jobs/{{$job['id']}}" class="text-gray-500 hover:underline">
                <li>
                    <strong>{{$job['title']}}:</strong> Pays {{$job['salary']}}
                </li>
            </a>
        @endforeach
    </ul>
</x-layout>
