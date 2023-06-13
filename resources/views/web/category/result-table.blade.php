@isset($data)

<table class="table table-success table-striped table-hover">
    <tr>
        <th hidden></th>
        <th></th>
        <th>дата</th>
        <th>транзакції</th>
        <th>категорії</th>
        <th>підкатегорії</th>
        <th>сума</th>
        <th>валюта</th>
    </tr>

    @foreach ($data as $element)
    <tr>
        <td hidden>{{ $element['id'] }}</td>
        <td><input type="checkbox" name="choice"></td>
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