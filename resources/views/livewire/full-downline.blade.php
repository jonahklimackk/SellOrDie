{{-- resources/views/livewire/full-downline.blade.php --}}
<div class="downline-cards">
    @foreach($tree as $branch)
        @include('livewire.partials.full-downline-card', [
          'branch' => $branch,
          'depth'  => 1,
        ])
    @endforeach
</div>
