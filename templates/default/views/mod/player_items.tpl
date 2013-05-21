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
    {% for ti in item_list %}
        {% set item = ti.createMaterial() %}
        <tr>
            <td>
                {{ item.getImage(32, 'img-polaroid')|raw }}
                {{ item.getName }}
            </td>
            <td>
                {{ ti.preparePickedUp }}
            </td>
            <td>
                {{ ti.prepareDropped }}
            </td>
        </tr>
    {% endfor %}
    </tbody>
</table>
<div id="block_listPagination" class="pagination-centered"></div>

<script type="text/javascript">
    $(document).ready(function () {
        callModulePage(
            'item_list',
            {{ item_list.getPages }},
            {{ item_list.getPage }}
        );
    });
</script>