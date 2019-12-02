$.fn.extend({
    sorttable: function (setting) {
        // 配置参数
        var configer = $.fn.extend({
            // 属性
			ascClass:'tablesorter-headerAsc',
			descClass:'tablesorter-headerDesc',
			onSorted: null // 排序完成回调函数
        }, setting);

        // 获取扩展对象
        var extObj = $(this);
        // 排序属性的可取值
        var sortOrder = {
            byAsc: "asc",
            byDesc: "desc"
        };
        // 自定义属性名
        var myAttrs = {
            order: "order",
            by: "by",
            sort: "sort"
        };
        // 可排序行的头列
        var headCells = extObj.find("tr[role='head']>[" + myAttrs.sort + "='true']");
        headCells.each(function () {
			$(this).addClass('tablesorter-header');
            $(this).css("cursor", "default");
			$(this).attr('by','desc');
        });

        // 设置头列点击事件
        headCells.click(function () {
            var thisCell = $(this);
			// 设置列排序
            SetColumnOrder(thisCell);
            // 所有头部的列的排序标记设置为false
            headCells.attr(myAttrs.order, false);
            // 被点击列的排序标志设置为true
            thisCell.attr(myAttrs.order, true);
            // 设置排序列的排序规则
            var by = thisCell.attr(myAttrs.by);
            thisCell.attr(myAttrs.by, (by == sortOrder.byAsc ? sortOrder.byDesc : sortOrder.byAsc));

        });
		
		function FireHandleAfterSortting(name,order) {
            if (configer.onSorted != null) {
                configer.onSorted(name,order);
            }
        }

        //说明：设置列排序
        function SetColumnOrder(headCell) {
            var by = headCell.attr(myAttrs.by);
			var name = headCell.attr('name');
            // 显示箭头排序列图标
			headCells.removeClass(configer.ascClass);
			headCells.removeClass(configer.descClass);
            if (by == sortOrder.byAsc) {
				headCell.addClass(configer.ascClass);
				order='asc';
            }
            else {
				headCell.addClass(configer.descClass);
				order='desc';
            }
			FireHandleAfterSortting(name,order);
			
        }
		

    }
});