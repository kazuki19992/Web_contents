var Desktop = {
    options: {
        windowArea: ".window-area",
        windowAreaClass: "",
        taskBar: ".task-bar > .tasks",
        taskBarClass: ""
    },

    wins: {},

    setup: function(options) {
        this.options = $.extend({}, this.options, options);
        return this;
    },

    addToTaskBar: function(wnd) {
        var icon = wnd.getIcon();
        var wID = wnd.win.attr("id");
        var item = $("<span>").addClass("task-bar-item started").html(icon);

        item.data("wID", wID);

        item.appendTo($(this.options.taskBar));
    },

    removeFromTaskBar: function(wnd) {
        console.log(wnd);
        var wID = wnd.attr("id");
        var items = $(".task-bar-item");
        var that = this;
        $.each(items, function() {
            var item = $(this);
            if (item.data("wID") === wID) {
                delete that.wins[wID];
                item.remove();
            }
        })
    },

    createWindow: function(o) {
        o.onDragStart = function() {
            win = $(this);
            $(".window").css("z-index", 1);
            if (!win.hasClass("modal"))
                win.css("z-index", 3);
        };
        o.onDragStop = function() {
            win = $(this);
            if (!win.hasClass("modal"))
                win.css("z-index", 2);
        };
        o.onWindowDestroy = function(win) {
            Desktop.removeFromTaskBar($(win));
        };
        var w = $("<div>").appendTo($(this.options.windowArea));
        var wnd = w.window(o).data("window");

        var win = wnd.win;
        var shift = Metro.utils.objectLength(this.wins) * 16;

        if (wnd.options.place === "auto" && wnd.options.top === "auto" && wnd.options.left === "auto") {
            win.css({
                top: shift,
                left: shift
            });
        }
        this.wins[win.attr("id")] = wnd;
        this.addToTaskBar(wnd);
        w.remove();

        return wnd;
    }
};

Desktop.setup();

var w_icons = [
    'rocket', 'apps', 'cog', 'anchor'
];
var w_titles = [
    'rocket', 'apps', 'cog', 'anchor'
];

function createWindow() {
    var index = Metro.utils.random(0, 3);
    var w = Desktop.createWindow({
        resizeable: true,
        draggable: true,
        width: 300,
        icon: "<span class='mif-" + w_icons[index] + "'></span>",
        title: w_titles[index],
        content: "<div class='p-2'>This is desktop demo created with Metro 4 Components Library</div>"
    });

    setTimeout(function() {
        console.log(w);
        w.setContent("New window content");
    }, 3000);
}

function createWindowAbout() {
    var index = Metro.utils.random(0, 3);
    var w = Desktop.createWindow({
        resizeable: true,
        draggable: true,
        width: 600,
        icon: "<span class='mif-info'></span>",
        title: "About.",
        content: "<h1>About Desktop-mode.</h1> <ul><li>作成者：Ukraine</li><li>改変　：櫛田一樹</li><li>version：0.1.0</li></ul><BR><BR><center><div class='p-2'>Metro 4 (Metro UI CSS) © 2012-2018 by Sergey Pimenov.<BR>Domain by Imena.ua. Hosting by Mirohost.<BR>Metro CDN by KeyCDN.<BR>IDE PhpStorm by JetBrains.<BR>Currently 4.2.45. Code licensed MIT, docs CC BY 3.0.</div></center>"
    });
}

function createWindowWithCustomButtons() {
    var index = Metro.utils.random(0, 3);
    var customButtons = [{
            html: "<span class='mif-rocket'></span>",
            cls: "sys-button",
            onclick: "alert('You press rocket button')"
        },
        {
            html: "<span class='mif-user'></span>",
            cls: "alert",
            onclick: "alert('You press user button')"
        },
        {
            html: "<span class='mif-cog'></span>",
            cls: "warning",
            onclick: "alert('You press cog button')"
        }
    ];
    Desktop.createWindow({
        resizeable: true,
        draggable: true,
        customButtons: customButtons,
        width: 360,
        icon: "<span class='mif-" + w_icons[index] + "'></span>",
        title: w_titles[index],
        content: "<div class='p-2'>This is desktop demo created with Metro 4 Components Library.<br><br>This window has a custom buttons in caption.</div>"
    });
}

function createWindowModal() {
    Desktop.createWindow({
        resizeable: false,
        draggable: true,
        width: 300,
        icon: "<span class='mif-cogs'></span>",
        title: "Modal window",
        content: "<div class='p-2'>This is desktop demo created with Metro 4 Components Library</div>",
        overlay: true,
        //overlayColor: "transparent",
        modal: true,
        place: "center",
        onShow: function(win) {
            $(win).addClass("ani-swoopInTop");
            setTimeout(function() {
                $(win).removeClass("ani-swoopInTop");
            }, 1000);
        },
        onClose: function(win) {
            $(win).addClass("ani-swoopOutTop");
        }
    });
}

function createWindowBrowse() {
    Desktop.createWindow({
        resizeable: true,
        draggable: true,
        width: 1280,
        height: 720,
        icon: "<span class='mif-ie'></span>",
        title: "Internet viewer",
        content: "<iframe src=\"http://localhost\" width=\"1280\", height=\"720\">",
        clsContent: "bg-dark"
    });
}

function openCharm() {
    var charm = $("#charm").data("charms");
    charm.toggle();
}

$(".window-area").on("click", function() {
    Metro.charms.close("#charm");
});

$(".charm-tile").on("click", function() {
    $(this).toggleClass("active");
});