window.settings = {
    "act_name": `第四届「後山」校园街舞大赛`,
    "act_info": "主办单位：校艺术团",

    /* 注意：只能倒计时一天。时间处理的代码太麻烦了，不想写。 */
    "start_time": new Date("2022-12-01 17:50:00"),
    "poster_img": "image/主视觉.png",


    // pause.html用法：
    // pause.html?tpl=normal/rest/rest_vs....
    "pause": {
        "normal": {
            "title": "活动暂停",
            "description_html": "请稍待",
        },

        "rest": {
            "title": "中场休息中",
            "description_html": "18:45 继续比赛",
        },

        "rest_vs": {
            "title": "中场休息中",
            "description_html": "18:45 继续比赛<br/>A学院 VS B学院",
        },

    },


    "backend_server": "http://127.0.0.1:26666",
}
