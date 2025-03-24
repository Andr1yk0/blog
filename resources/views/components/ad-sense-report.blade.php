@php
    use Google\Service\Adsense\ReportResult;

    /**
     * @var ReportResult $reportResult
     */
@endphp

<div>
        <div
            class="min-w-full overflow-x-auto rounded-sm border border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800"
        >
            <table class="min-w-full align-middle text-sm whitespace-nowrap">
                <thead>
                <tr class="border-b border-gray-100 dark:border-gray-700/50">
                    @foreach($headers as $header)
                        <th
                            class="bg-gray-100/75 px-3 py-4 text-center font-semibold text-gray-900 dark:bg-gray-700/25 dark:text-gray-50"
                        >
                            {{$header->name}}
                        </th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($rows as $row)
                    <tr class="border-b border-gray-100 dark:border-gray-700/50">
                        @foreach($row->cells as $cell)
                            <td class="p-3 text-center">{{$cell->value}}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
</div>