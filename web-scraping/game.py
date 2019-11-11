import time
import random


def win(uStr, rStr):
    """Text for your win"""
    print("You chose",uStr,"! Your challenger chose",str.lower(rStr),"!  YOU WIIIIIIIN!!\n")

def lose(uStr, rStr):
    """Text for your loss"""
    print("You chose",str.lower(uStr),"! Your challenger chose",rStr,"!  YOU looooooooose!!\n")

def tie(uStr, rStr):
    """Text for a tie"""
    print("You chose",uStr,"! Your challenger also chose",rStr,"!  Great minds think alike, but great minds must play agaaaaaiiiin!\n")


def battle(uVar, rVar, uStr, rStr):
    """The actual battle"""
    if(uVar == 0 or uVar > 3):
        print("Not an appropriate hand-gesture!\n")
    elif(uVar == rVar):
        tie(uStr, rStr)
    elif(uVar == rVar + 1 or uVar == rVar - 2):
        win(uStr, rStr)
    elif(uVar == rVar - 1 or uVar == rVar + 2):
        lose(uStr, rStr)
    else:
        print("Not an appropriate hand-gesture!\n")

def main():
    breakPoint = False
    while not breakPoint:
        validInput = False
        while not validInput:
        # Loop user input request
            try:
                uVar = int(input("Choose your weapon! 1 = Rock, 2 = Paper, 3 = Scissors: "))
                rVar = random.randint(1, 3)
                uStr = "ROOOCK" if uVar == 1 else "PAPEEER" if uVar == 2 else "SCISSOOORS"
                rStr = "ROOOCK" if rVar == 1 else "PAPEEER" if rVar == 2 else "SCISSOOORS"
                validInput = True
            except:
                print("Unknown error")
            print("Throw your hand in 3...")
            time.sleep(1)
            print("2..")
            time.sleep(1)
            print("1.")
            time.sleep(1)
            battle(uVar, rVar, uStr, rStr)
        contVar1 = input('Press enter to start again or press x to exit\n')
        if (contVar1 == 'X' or contVar1 == 'x'):
            breakPoint = True
        else:
            breakPoint = False
main()