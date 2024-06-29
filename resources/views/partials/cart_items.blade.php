@foreach($items as $item)
<tr data-id="{{ $item->id }}">
    <td>
        @if(isset($item->attributes['image']))
        <img src="{{ asset($item->attributes['image']) }}" alt="{{ $item->name }}" style="width: 100px; height: 100px;">
        @else
        <span>No Image</span>
        @endif
    </td>
    <td>{{ $item->name }}</td>
    <td>${{ $item->price }}</td>
    <td>
        <button class="btn btn-secondary btn-sm decrease-quantity" data-id="{{ $item->id }}">-</button>
        <span class="quantity" data-id="{{ $item->id }}">{{ $item->quantity }}</span>
        <button class="btn btn-secondary btn-sm increase-quantity" data-id="{{ $item->id }}">+</button>
    </td>
    <td>
        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $item->id }}">Quitar</button>
    </td>
</tr>
@endforeach
