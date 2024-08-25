@props(['status'])

@if ($status)
{{{info('inside login blade')}}}
{{info($status)}}
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 dark:text-green-400']) }}>
        {{ $status }}
    </div>
@endif
