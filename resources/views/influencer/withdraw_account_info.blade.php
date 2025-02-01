<div class="alert alert-primary" role="alert">
    <h5>{{__('admin.Withdraw Limit')}} :

        {{ currency($method->min_amount) }} - {{ currency($method->max_amount) }}

    </h5>
    <h5>{{__('admin.Withdraw charge')}} : {{ $method->withdraw_charge }}%</h5>
    {!! clean($method->description) !!}
</div>
