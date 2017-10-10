using System;
using System.IO;
using System.Net;

namespace TMC_Example
{
    public class TMC
    {
        public enum ResultCodes
        {
            NotDisposable = 1,
            Disposable = 2,
            Invalid = 3
        }
        
        // Custom dummy function I've made to work around the JSON libraries

        private static string GetValueFromJSON(string json, string start_key, string end_key)
        {
            int start_index = json.IndexOf(start_key);
            int end_index = json.IndexOf(end_key, start_index + start_key.Length);
            return json.Substring(start_index + start_key.Length, end_index - end_key.Length - start_key.Length - start_index);
        }

        public static ResultCodes IsDisposableEmail(string email)
        {
            try
            {
                var addr = new System.Net.Mail.MailAddress(email);
                if (addr.Address == email)
                {
                    HttpWebRequest req = (HttpWebRequest)WebRequest.Create("https://services.toxiicdev.net/tmc/check.php?email=" + email);
                    req.Method = "GET";

                    HttpWebResponse res = (HttpWebResponse)req.GetResponse();
                    StreamReader s = new StreamReader(res.GetResponseStream());
                    string reply = s.ReadToEnd();
                    s.Dispose();
                    res.Dispose();
                    if (reply.Length != 0)
                    {
                        int responseCode = int.Parse(GetValueFromJSON(reply, "result_code\":", "\""));

                        return (ResultCodes)responseCode;
                    }
                }
            }
            catch { }

            return ResultCodes.Invalid;
        }
    }
}
