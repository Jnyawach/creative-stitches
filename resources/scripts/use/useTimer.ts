import {ref} from "vue";

export function useTimer(timer:any){
    const  timerOutput =ref('');
    function startTimer() {
        const timeNow = new Date().getTime();
        const timeDifference = timer - timeNow;
        const millisecondsInOneSecond = 1000;
        const millisecondsInOneMinute = millisecondsInOneSecond * 60;
        const millisecondsInOneHour = millisecondsInOneMinute * 60;
        const millisecondsInOneDay = millisecondsInOneHour * 24;
        const differenceInDays = timeDifference / millisecondsInOneDay;
        const remainderDifferenceInHours = (timeDifference % millisecondsInOneDay) / millisecondsInOneHour;
        const remainderDifferenceInMinutes = (timeDifference % millisecondsInOneHour) / millisecondsInOneMinute;
        const remainderDifferenceInSeconds = (timeDifference % millisecondsInOneMinute) / millisecondsInOneSecond;
        const remainingDays = Math.floor(differenceInDays);
        const remainingHours = Math.floor(remainderDifferenceInHours);
        const remainingMinutes = Math.floor(remainderDifferenceInMinutes);
        const remainingSeconds =Math.floor(remainderDifferenceInSeconds);
       timerOutput.value = remainingDays + " Days " + ": " + remainingHours + " Hours " + ": " + remainingMinutes + " Minutes " + ": " + remainingSeconds + " Seconds";
    }
    return{
        timerOutput
    }
}
