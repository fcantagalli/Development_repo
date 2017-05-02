package recfun

object Main {
  def main(args: Array[String]) {
    println("Pascal's Triangle")
    for (row <- 0 to 10) {
      for (col <- 0 to row)
        print(pascal(col, row) + " ")
      println()
    }
  }

  /**
   * Exercise 1
   */
    def pascal(c: Int, r: Int): Int = {
      if (r == 0) return 1
      if (c == 0 || c == r) return 1
      return pascal(c-1, r-1) + pascal(c, r-1)
    }

  /**
   * Exercise 2
   */
    def balance(chars: List[Char]): Boolean = {

      def findEnd(chars: List[Char], nEnds: Int): List[Char] = {
        if (chars.isEmpty) return Nil
        (chars.head) match {
          case ')' => if (nEnds > 1) return findEnd(chars.tail, nEnds - 1)
                      else return chars
          case '(' => return findEnd(chars.tail, nEnds + 1)
          case _ => return findEnd(chars.tail, nEnds)
        }
      }

      if (chars.isEmpty) return true
      (chars.head) match {
        case '(' => {
          def listToContinue = findEnd(chars.tail, 1)
          if (listToContinue == Nil) return false
          else return balance(listToContinue.tail)
        }
        case ')' => return false
        case _ => return balance(chars.tail)
      }
    }
  
  /**
   * Exercise 3
   */
    def countChange(money: Int, coins: List[Int]): Int = {
      if(money == 0) return 1
      if(money > 0 && !coins.isEmpty)
        return countChange(money - coins.head, coins) + countChange(money, coins.tail)
      else
        return 0
    }
  }
