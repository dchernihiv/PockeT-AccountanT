@isset($data)

<table class="table table-success table-striped table-hover">
    <tr>
        <th>дата</th>
        <th>транзакції</th>
        <th>категорії</th>
        <th>підкатегорії</th>
        <th>сума</th>
        <th>валюта</th>
    </tr>

    @foreach ($data as $element)
    <tr>
        <td>{{ $element['date'] }}</td>
        <td>{{ $element['transaction'] }}</td>
        <td>{{ $element['category'] }}</td>
        <td>{{ $element['subcategory'] }}</td>
        <td>{{ $element['sum'] }}</td>
        <td>{{ $element['currency'] }}</td>
    </tr>
    @endforeach
</table>

@endisset