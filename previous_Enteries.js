const date = new Date();
function renderCalendar()
{
    const monthDays = document.querySelector('.days');
    let lastDay = new Date(date.getFullYear(),date.getMonth()+1,0).getDate();
    
    const firstDayIndex = new Date(date.getFullYear(),date.getMonth(),1).getDay();
    
    const prevLastDay = new Date(date.getFullYear(),date.getMonth(),0).getDate();
    
    const lastDayIndex = new Date(date.getFullYear(),date.getMonth()+1,0).getDay();
    
    const nextDays = 7 -lastDayIndex -1;
    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];
    
    
    document.querySelector('.date h1').innerHTML=months[date.getMonth()];

    let days = "";
    for(let count = firstDayIndex ; count>0 ; count--)
    {
        days += '<div class="prev-date">'+ (prevLastDay - count +1)+'</div>'
    }
    
     console.log(days);
    for(let i=1;i <= lastDay;i++){
        if(i===new Date().getDate() && date.getMonth() === new Date().getMonth())
        {
            days += '<div class="today">'+i+'</div>';
        }
        else{
            days += "<div>"+i+"</div>";
        }
       
        
    }
    if(nextDays >= 1)
    {
        for(let j = 1; j <= nextDays; j++){
            days += `<div class="next-date" onclick="selected()">${j}</div>`;
            monthDays.innerHTML=days;
        }
    }
    else
    {
        for(let k = 0; k <= nextDays; k++){
            days += `<div class="invisible"></div>`;
            monthDays.innerHTML=days;
        }
    }
  
}


 
document.querySelector(".prev").addEventListener("click",()=> {
    date.setMonth(date.getMonth()-1);
    renderCalendar();
});
document.querySelector(".next").addEventListener("click",()=> {
    date.setMonth(date.getMonth()+1);
    renderCalendar();
});
renderCalendar();