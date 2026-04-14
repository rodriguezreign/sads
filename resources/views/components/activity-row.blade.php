@props(['id', 'item', 'status', 'badgeClass', 'user', 'date'])

<tr>
    <td>{{ $id }}</td>
    <td><strong>{{ $item }}</strong></td>
    <td><span class="badge {{ $badgeClass }}">{{ $status }}</span></td>
    <td>{{ $user }}</td>
    <td>{{ $date }}</td>
    <td>
        <button class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;" onclick="viewItem('{{ $id }}')">View</button>
    </td>
</tr>