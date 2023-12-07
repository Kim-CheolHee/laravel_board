import Sortable from 'sortablejs'

window.sortableList = () => {
    return {
        items: ['Item 1', 'Item 2', 'Item 3', 'Item 4', 'Item 5'],

        init() {
            Sortable.create(document.getElementById('sortable-list'), {
                animation: 150,
                ghostClass: 'sortable-ghost',
                handle: '.drag-handle', // 드래그 핸들 지정
                onEnd: (event) => {
                    // 배열 아이템 재정렬 로직
                    const [movedItem] = this.items.splice(event.oldIndex, 1);
                    this.items.splice(event.newIndex, 0, movedItem);
                }
            });
        }
    }
}
