from flask import Flask, render_template, request, redirect, session, url_for
from flask_mysqldb import MySQL
import MySQLdb

###
import mysql.connector
import operator
import cgi

###
import pandas as pd
import mysql.connector
from dictinary import s_active, s_reg
import functools

# re_data=0

app = Flask(__name__)
app.secret_key = "1234353234"

app.config["MYSQL_HOST"] = "localhost"
app.config["MYSQL_USER"] = "root"
app.config["MYSQL_PASSWORD"] = ""
app.config["MYSQL_DB"] = "project"

db = MySQL(app)


@app.route('/', methods=['GET', 'POST'])
def index():
    if request.method == 'POST' and 'username' in request.form and 'password' in request.form:
        username = request.form['username']
        password = request.form['password']
        cursor = db.connection.cursor(MySQLdb.cursors.DictCursor)
        cursor.execute("SELECT * FROM login WHERE username=%s AND password=%s", (username, password))
        info = cursor.fetchone()
        if info is not None:
            if info['username'] == username and info['password'] == password:
                session['loginsuccess'] = True
                return redirect(url_for('profile'))
        else:
            return redirect(url_for('index'))

    return render_template("login2.html")


@app.route('/new/profile')
def profile():
    if session['loginsuccess'] == True:
        return render_template("profile.html")

@app.route('/new/profile', methods=["GET", "POST"])
def demo():
    # global re_data
    if request.method =="POST":
        re_data=request.form.get("fname")
        print("Content-Type: text/html")
        print()
        print("""
           <TITLE>CGI script ! Python</TITLE>
           <H1>This is my first CGI script</H1>
           """)


        form = cgi.FieldStorage()
        searchterm = form.getfirst("searchbox")
        df = pd.read_csv(r"C:\xampp\htdocs\Mini_project_2021\state_final.csv")
        res = pd.read_csv(r"C:\xampp\htdocs\Mini_project_2021\new_register_statewise.csv")

        print(searchterm)

        dic = {}
        length = len(df)
        for i in range(length):
            dic[df.State[i]] = df.Active[i]
        sort_dic = (sorted(dic.items(), key=lambda kv: (kv[1], kv[0])))
        sorted_d = dict(sorted(dic.items(), key=operator.itemgetter(1), reverse=True))
        l = len(sorted_d)

        reg = {}
        lengthr = len(res)
        for i in range(lengthr):
            reg[res.States[i]] = res.register[i]

        myconn = mysql.connector.connect(host="localhost", user="root", password="", database="vaccines")
        cur = myconn.cursor()
        k = sorted_d.keys()
        kd = dic.keys()
        vac = int(re_data)
        print(vac)
        for i in k:
            t = vac * 0.1
            if i in reg:
                if reg[i] < t:
                    sql = "UPDATE vaccines.state_final SET NO_of_vaccines= %s WHERE State=%s"
                    val = (reg[i], i)
                    cur.execute(sql, val)
                    myconn.commit()
                    vac = vac - reg[i]
                else:
                    sql = "UPDATE vaccines.state_final SET NO_of_vaccines= %s WHERE State=%s"
                    val = (t, i)
                    cur.execute(sql, val)
                    myconn.commit()
                    vac = vac - t


        db = pd.read_csv(r"C:\xampp\htdocs\Mini_project_2021\vaccine_database.csv")
        reg = pd.read_csv(r"C:\xampp\htdocs\Mini_project_2021\Register_District.csv")

        myconn = mysql.connector.connect(host="localhost", user="root", password="", database="district")
        cur = myconn.cursor()
        con1 = mysql.connector.connect(host="localhost", user="root", password="", database="vaccines")
        cur1 = con1.cursor()
        cur1.execute("SELECT NO_of_vaccines FROM state_final")
        vac = []
        for i in range(37):
            info = cur1.fetchone()
            res = functools.reduce(lambda sub, ele: sub * 10 + ele, info)
            vac.append(res)
        print(vac[0])
        a = []
        b = []
        for i in s_active:
            a.append(i)

        for i in s_reg:
            b.append(i)

        for i in range(len(db)):
            var = vac[i]
            for j in a:
                if db.State[i] == j:
                    c = s_active[j]
                    d = s_reg[j]
                    for k in c:
                        t = var * 0.1
                        for m in d:
                            if k == m:
                                if d[m] < t:
                                    sql = "UPDATE district.district_sample SET NO_of_vaccines= %s WHERE District=%s"
                                    val = (int(d[m]), m)
                                    cur.execute(sql, val)
                                    myconn.commit()
                                    var = var - d[m]
                                else:
                                    sql = "UPDATE district.district_sample SET NO_of_vaccines= %s WHERE District=%s"
                                    val = (int(t), m)
                                    cur.execute(sql, val)
                                    myconn.commit()
                                    var = var - t

        # return "DATA "+re_data
    return render_template("profile.html")



if __name__ == "__main__":
    app.run(debug=True)



