@foreach (config('billing.plans') as $key => $priceId)
  <a
    href="{{ route('subscriptions.checkout', ['planKey' => $key]) }}"
    class="btn btn-primary mb-2"
  >
    Subscribe: {{ Str::title(str_replace('_', ' ', $key)) }}
  </a>
  <br><br>
@endforeach