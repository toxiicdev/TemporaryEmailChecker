/* Temporary Email Checker

Written by: toxiicdev.net
Language: C#

*/

using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace TMC_Example
{
    class Program
    {
        static void Main(string[] args)
        {
            Console.Write("Insert your email: ");
            string email = Console.ReadLine();

            TMC.ResultCodes code = TMC.IsDisposableEmail(email);

            switch (code)
            {
                case TMC.ResultCodes.NotDisposable:
                    {
                        Console.WriteLine("Email is not disposable");
                        break;
                    }
                case TMC.ResultCodes.Disposable:
                    {
                        Console.WriteLine("Email is disposable");
                        break;
                    }
                default:
                    {
                        Console.WriteLine("Email is valid");
                        break;
                    }
            }

            Console.ReadLine();
        }
    }
}
