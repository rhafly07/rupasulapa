@props([
    'headers' => [],
    'data' => [],
])

<table class="w-full border-collapse">
    <thead>
        <tr class="bg-gray-100">
            @foreach ($headers as $header)
                <th class="px-4 py-2 text-red-700 first:rounded-l-xl last:rounded-r-xl">
                    {{ $header }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $row)
            <tr class="border-b hover:bg-gray-50 transition">
                @foreach ($row as $cell)
                    <td class="p-4">
                        {{ $cell ?? '-' }}
                    </td>
                @endforeach
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($headers) }}" class="text-center py-4 text-gray-500">
                    Tidak ada data
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
