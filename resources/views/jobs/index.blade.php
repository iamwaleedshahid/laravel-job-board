<x-layout>
@include('partials._hero')
@include('partials._search')
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
@unless(empty($jobs))
@foreach ($jobs as $job)
<x-job-card :job="$job" />
@endforeach
@else
<p>No jobs found</p>
@endunless
</div>

<div class="mt-6 p-4">
{{ $jobs->links() }}
</div>
</x-layout>