<table class="table table-striped table-bordered table-vcenter">
    <thead>
    <tr>
        <th class="sort-button {{ sort[1] }}" data-type="1" data-sort="asc">
            {{ 'block_type'|trans }}
        </th>
        <th class="sort-button {{ sort[2] }}" data-type="2" data-sort="asc">
            {{ 'destroyed'|trans }}
        </th>
        <th class="sort-button {{ sort[3] }}" data-type="3" data-sort="asc">
            {{ 'placed'|trans }}
        </th>
    </tr>
    </thead>
    <tbody class="content">
    {% for block in block_list %}
        <tr>
            <td>
                {{ block.getImage(32, 'img-polaroid')|raw }}
                {{ block.getName }}
            </td>
            <td>
                {{ staticCall('TotalBlock', 'countAllOfType', ['destroyed', block])|ffNumber }}
            </td>
            <td>
                {{ staticCall('TotalBlock', 'countAllOfType', ['placed', block])|ffNumber }}
            </td>
        </tr>
    {% endfor %}
    </tbody>
</table>
<div id="block_listPagination" class="pagination-centered"></div>

<script type="text/javascript">
    $(document).ready(function () {
        callModulePage(
            'block_list',
            {{ block_list.getPages }},
            {{ block_list.getPage }}
        );
    });
</script>