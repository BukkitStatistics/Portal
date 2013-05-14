<table class="table table-striped table-bordered table-vcenter">
    <thead>
    <tr>
        <th class="sort-button {{ sort[1] }}" data-type="1" data-sort="asc">
            {{ 'item_type'|trans }}
        </th>
        <th class="sort-button {{ sort[2] }}" data-type="2" data-sort="asc">
            {{ 'picked_up'|trans }}
        </th>
        <th class="sort-button {{ sort[3] }}" data-type="3" data-sort="asc">
            {{ 'dropped'|trans }}
        </th>
    </tr>
    </thead>
    <tbody class="content">
    {% for item in item_list %}
        <tr>
            <td>
                {{ item.getImage(32, 'img-polaroid')|raw }}
                {{ item.getName }}
            </td>
            <td>
                {{ staticCall('TotalItem', 'countAllOfType', ['picked_up', item])|ffNumber }}
            </td>
            <td>
                {{ staticCall('TotalItem', 'countAllOfType', ['dropped', item])|ffNumber }}
            </td>
        </tr>
    {% endfor %}
    </tbody>
</table>
<div id="item_listPagination" class="pagination-centered"></div>

<script type="text/javascript">
    $(document).ready(function () {
        callModulePage(
            'item_list',
            {{ item_list.getPages }},
            {{ item_list.getPage }}
        );
    });
</script>