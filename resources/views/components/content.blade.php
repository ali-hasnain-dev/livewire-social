<div x-data="{ expanded: false }">
    <p x-show="expanded" x-collapse.min.62px>
        <span x-text='data.content' @click="expanded = ! expanded" class="cursor-pointer"></span>
    </p>
</div>
