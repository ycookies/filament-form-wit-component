@once
<style>
    .week-time-picker {
        border: 1px solid #eee;
        border-radius: 4px;
        background: white;
        overflow-x: auto;
        max-width: 100%;
        font-size: 12px;
    }
    .week-time-picker table {
        width: max-content;
        min-width: 100%;
        border-collapse: collapse;
    }
    .week-time-picker th, .week-time-picker td {
        border: 1px solid #eee;
        padding: 4px;
        text-align: center;
        min-width: 40px;
    }
    .week-time-picker th {
        background: #f5f5f5;
        white-space: nowrap;
    }
    .week-time-picker .cell {
        width: 30px;
        height: 30px;
        cursor: pointer;
        margin: 0 auto;
    }
    .week-time-picker .cell.selected {
        background: #60a5fa;
        color: white;
    }
    .week-time-picker .controls {
        padding: 8px;
        background: #f9fafb;
        border-bottom: 1px solid #eee;
        position: sticky;
        left: 0;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .week-time-picker .controls .left-buttons {
        display: flex;
        gap: 8px;
    }
    .week-time-picker .controls button {
        font-size: 12px;
        margin-right: 8px;
        padding: 4px 6px;
        border-radius: 4px;
        border: 1px solid #ddd;
        background: white;
    }
    .week-time-picker .controls button.primary {
        background: #60a5fa;
        color: white;
        border: none;
    }
    .week-time-picker td:first-child,
    .week-time-picker th:first-child {
        position: sticky;
        left: 0;
        background: white;
        z-index: 1;
    }
    .week-time-picker th:first-child {
        background: #f5f5f5;
    }
    .week-time-picker .legend {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 12px;
        margin-right: 8px;
    }
    .week-time-picker .legend-item {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .week-time-picker .legend-color {
        width: 16px;
        height: 16px;
        border-radius: 2px;
        border: 1px solid #eee;
    }
    .week-time-picker .legend-color.selected {
        background: #60a5fa;
    }
</style>
@endonce

<x-dynamic-component
        :component="$getFieldWrapperView()"
        :field="$field"
>
    <div
            x-data="{
            state: $wire.$entangle('{{ $getStatePath() }}'),
            selected: {},
            init() {
                this.selected = this.state ? JSON.parse(this.state) : {};
            },
            toggle(day, hour) {
                const key = `${day}-${hour}`;
                if (this.selected[key]) {
                    delete this.selected[key];
                } else {
                    this.selected[key] = true;
                }
                this.state = JSON.stringify(this.selected);
            },
            isSelected(day, hour) {
                return this.selected[`${day}-${hour}`] || false;
            },
            selectAll() {
                for (let day = 1; day <= 7; day++) {
                    for (let hour = 0; hour < 24; hour++) {
                        this.selected[`${day}-${hour}`] = true;
                    }
                }
                this.state = JSON.stringify(this.selected);
            },
            clear() {
                this.selected = {};
                this.state = JSON.stringify(this.selected);
            }
        }"
            class="week-time-picker"
    >
        <div class="controls">
            <div class="left-buttons">
                <button type="button" class="primary" @click="selectAll">{{ __('formwitcomponent::plugins.week-time-picker.controls.select_all') }}</button>
                <button type="button" @click="clear">{{ __('formwitcomponent::plugins.week-time-picker.controls.clear') }}</button>
            </div>
            
            <div class="legend">
                <div class="legend-item">
                    <div class="legend-color selected"></div>
                    <span>{{ __('formwitcomponent::plugins.week-time-picker.header.selected') }}</span>
                </div>
                <div class="legend-item">
                    <div class="legend-color"></div>
                    <span>{{ __('formwitcomponent::plugins.week-time-picker.header.unselected') }}</span>
                </div>
            </div>
        </div>

        <table>
            <thead>
            <tr>
                <th>{{ __('formwitcomponent::plugins.week-time-picker.header.weekday_time') }}</th>
                @for ($hour = 0; $hour < 24; $hour++)
                    <th>{{ $hour }}{{ __('formwitcomponent::plugins.week-time-picker.time.hour') }}</th>
                @endfor
            </tr>
            </thead>
            <tbody>
            @php
                $weekdays = [
                    __('formwitcomponent::plugins.week-time-picker.weekdays.monday'),
                    __('formwitcomponent::plugins.week-time-picker.weekdays.tuesday'),
                    __('formwitcomponent::plugins.week-time-picker.weekdays.wednesday'),
                    __('formwitcomponent::plugins.week-time-picker.weekdays.thursday'),
                    __('formwitcomponent::plugins.week-time-picker.weekdays.friday'),
                    __('formwitcomponent::plugins.week-time-picker.weekdays.saturday'),
                    __('formwitcomponent::plugins.week-time-picker.weekdays.sunday'),
                ];
            @endphp
            @foreach($weekdays as $index => $day)
                <tr>
                    <td>{{ $day }}</td>
                    @for ($hour = 0; $hour < 24; $hour++)
                        <td>
                            <div
                                    class="cell"
                                    :class="{ 'selected': isSelected({{ $index + 1 }}, {{ $hour }}) }"
                                    @click="toggle({{ $index + 1 }}, {{ $hour }})"
                            ></div>
                        </td>
                    @endfor
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-dynamic-component>