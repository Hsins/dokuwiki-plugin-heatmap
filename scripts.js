/**
 * Scripts of the heatmap Plugin
 *
 * add event listener to render TeX expressions with KaTeX
 *
 * @license GPLv3 https://www.gnu.org/licenses/gpl-3.0.html
 * @author  H.-H. PENG (Hsins) <hsinspeng@gmail.com>
 */

document.addEventListener('DOMContentLoaded', () => {
    let scriptTags = document.querySelectorAll('script[type="application/json"]');
  
    scriptTags.forEach((script) => {
      if (!script.id.startsWith('data-heatmap')) return;
      const heatmapId = script.id.replace('data-', '');
      const data = JSON.parse(script.textContent);
  
      // Reqired Data
      const dateRange = data.dateRange;
      const postCount = data.postCount;
      const postMap = new Map(Object.entries(data.postMap).map(entry => entry));
  
      const chartElement = document.getElementById(heatmapId);
      const chart = echarts.init(chartElement, null, opts = { locale: "ZH" });
      window.onresize = () => { chart.resize() };
  
      const option = {
        tooltip: {
          triggerOn: "mousemove|click",
          hideDelay: 800,
          enterable: true,
          backgroundColor: "#f4f4f4",
          borderColor: "#67320e",
          formatter: function (params) {
            const date = params.data[0];
            const posts = postMap.get(date);
            let content = `${date}`;
            for (const [i, post] of posts.entries()) {
              content += "<br>";
              var url = post.url;
              var title = post.title;
              content += `<a href="${url}" target="_blank">${title}</a>`;
            }
            return content;
          }
        },
        visualMap: {
            type: 'piecewise',
            orient: 'horizontal',
            calculable: true,
            showLabel: false,
            left: 0,
            bottom: 0,
            pieces: [{
              lte: 0,
              color: "#EBEDF0"
            }, {
              gt: 0,
              lte: 5,
              color: "#0E4429"
            }, {
              gt: 5,
              lte: 10,
              color: "#006D32"
            }, {
              gt: 10,
              lte: 15,
              color: "#26A641"  
            }, {
              gt: 15,
              color: "#39D353" 
            }]
        },
        calendar: {
          top: 60,
          left: 20,
          right: 0,
          cellSize: ['auto', 15],
          range: dateRange,
          itemStyle: {
            borderWidth: 3,
            borderCap: "round",
            borderJoin: "round",
            color: '#F1F1F1',
            borderColor: '#fff',
          },
          dayLabel: { show: true },
          monthLabel: { show: true },
          yearLabel: {
            show: true,
            position: "top",
            margin: 36,
            verticalAlign: "top"
          },
          // the splitline between months. set to transparent for now.
          splitLine: {
            lineStyle: {
              color: 'rgba(0, 0, 0, 0.0)',
              // shadowColor: 'rgba(0, 0, 0, 0.5)',
              // shadowBlur: 5,
              // width: 0.5,
              // type: 'dashed',
            }
          }
        },
        series: {
          type: 'heatmap',
          coordinateSystem: 'calendar',
          calendarIndex: 0,
          data: postCount,
        }
      };
      chart.setOption(option);
    });
  });
