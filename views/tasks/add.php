<div class="add-task-form regular-form">
    <form>
        <h3 class="head-main head-main">Публикация нового задания</h3>
        <div class="form-group">
            <label class="control-label" for="essence-work">Опишите суть работы</label>
            <input id="essence-work" type="text">
        </div>
        <div class="form-group">
            <label class="control-label" for="username">Подробности задания</label>
            <textarea id="username"></textarea>
        </div>
        <div class="form-group">
            <label class="control-label" for="town-user">Категория</label>
            <select id="town-user">
                <option>Курьерские услуги</option>
                <option>Грузоперевозки</option>
                <option>Клининг</option>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label" for="location">Локация</label>
            <input id="location" type="text">
        </div>
        <div class="half-wrapper">
            <div class="form-group">
                <label class="control-label" for="budget">Бюджет</label>
                <input id="budget" type="number">
            </div>
            <div class="form-group">
                <label class="control-label" for="period-execution">Срок исполнения</label>
                <input id="period-execution" type="date">
            </div>
        </div>
        <p class="form-label">Файлы</p>
        <div class="new-file">
            <p class="add-file">Добавить новый файл</p>
        </div>
        <input type="button" class="button button--blue" value="Опубликовать">
    </form>
</div>